<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Sales\Communication\Controller;

use Generated\Shared\Transfer\CommentTransfer;
use Spryker\Zed\Application\Business\Url\Url;
use Spryker\Zed\Application\Communication\Controller\AbstractController;
use Spryker\Zed\Sales\SalesConfig;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Zed\Sales\Communication\SalesCommunicationFactory getFactory()
 * @method \Spryker\Zed\Sales\Business\SalesFacade getFacade()
 */
class CommentController extends AbstractController
{

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function addAction(Request $request)
    {
        $idSalesOrder = $request->query->get(SalesConfig::PARAM_IS_SALES_ORDER);

        $formDataProvider = $this->getFactory()->createCommentFormDataProvider();
        $form = $this->getFactory()->createCommentForm(
            $formDataProvider->getData($idSalesOrder)
        );
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            return $this->submitCommentForm($form);
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function listAction(Request $request)
    {
        $idSalesOrder = $request->query->get(SalesConfig::PARAM_IS_SALES_ORDER);

        $comments = $this->getFacade()->getOrderCommentsByOrderId($idSalesOrder);

        return [
            'comments' => $comments->getComments(),
        ];
    }

    /**
     * @param Form $form
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function submitCommentForm(Form $form)
    {
        $formData = $form->getData();
        $idSalesOrder = $formData[CommentTransfer::FK_SALES_ORDER];

        if ($form->isValid()) {
            $comment = new CommentTransfer();
            $comment->setMessage($formData[CommentTransfer::MESSAGE]);
            $comment->setFkSalesOrder($idSalesOrder);

            $this->getFacade()->saveComment($comment);

            $this->addSuccessMessage('Comment successfully added');

        } else {
            /** @var FormError $error */
            foreach ($form->getErrors() as $error) {
                $this->addErrorMessage($error->getMessage());
            }
        }

        return $this->redirectUserToOrderDetails($idSalesOrder);
    }

    /**
     * @param int $idSalesOrder
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function redirectUserToOrderDetails($idSalesOrder)
    {
        $url = Url::generate('/sales/details', [
            SalesConfig::PARAM_IS_SALES_ORDER => $idSalesOrder,
        ]);

        return $this->redirectResponse($url->build());
    }

}
