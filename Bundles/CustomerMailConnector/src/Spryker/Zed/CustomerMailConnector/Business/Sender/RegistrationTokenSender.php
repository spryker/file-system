<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\CustomerMailConnector\Business\Sender;

use Generated\Shared\Transfer\MailTransfer;

class RegistrationTokenSender extends AbstractSender
{

    /**
     * @param string $email
     * @param string $token
     *
     * @return bool
     */
    public function send($email, $token)
    {
        $mailTransfer = $this->createMailTransfer();

        $mailTransfer->setTemplateName($this->config->getRegistrationToken());

        $this->addMailRecipient($mailTransfer, $email);
        $this->setMailTransferFrom($mailTransfer);
        $this->setMailTransferSubject($mailTransfer);
        $this->setMailMergeData($mailTransfer, $this->getMailGlobalMergeVars($token));

        $mailResponses = $this->mailFacade->sendMail($mailTransfer);
        $result = $this->mailFacade->isMailSent($mailResponses);

        return $result;
    }

    /**
     * @param MailTransfer $mailTransfer
     *
     * @return void
     */
    protected function setMailTransferSubject(MailTransfer $mailTransfer)
    {
        $subject = $this->config->getRegistrationSubject();
        if ($subject !== null) {
            $mailTransfer->setSubject($this->translate($subject));
        }
    }

    /**
     * @param string $token
     *
     * @return array
     */
    protected function getMailGlobalMergeVars($token)
    {
        $globalMergeVars = [
            'registration_token_url' => $token,
        ];

        return $globalMergeVars;
    }

}