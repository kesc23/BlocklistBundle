<?php
namespace MauticPlugin\BlocklistBundle\Controller;

use Mautic\CoreBundle\Controller\CommonController;

class DefaultController extends CommonController
{
    public function mainAction()
    {
        global $blocklist_postCond;
        $blocklist_postCond = (
            \isset( $_POST['Blocklist_mauticBaseUrl'] )
         && \isset( $_POST['Blocklist_clientKey'] )
         && \isset( $_POST['Blocklist_clientSecret'] )
        );

        if( $blocklist_postCond ):
            return $this->verifyOAuthAction();
        else:
            return $this->delegateView(
                array( 'contentTemplate' => 'BlocklistBundle:Main:main.html.php' )
            );
        endif;
    }

    public function verifyOAuthAction()
    {
        global $settings;

        /**
         * @todo load this array from database or config file
         */
        $accessTokenData = array(
            'accessToken' => '',
            'accessTokenSecret' => '',
            'accessTokenExpires' => ''
        );

        /**
         * @todo Sanitize this URL. Make sure it starts with http/https and doesn't end with '/'
         */
        $mauticBaseUrl = \urlencode( \rtrim( $_POST['Blocklist_mauticBaseUrl'] ) );

        /**
         * @todo Change this to your app callback. It should be the same as you entered when you were creating your Mautic API credentials.
         */
        $settings = array(
            'baseUrl'           => $mauticBaseUrl,
            'clientKey'         => $_POST['Blocklist_clientKey'],
            'clientSecret'      => $_POST['Blocklist_clientSecret'],
            'callback'          => rtrim( $mauticBaseUrl, "/s" ) . '/s/blocklist/authenticated',
            'version'           => 'OAuth2'
        );

        if( ! empty( $accessTokenData['accessToken'] ) && ! empty( $accessTokenData['accessTokenSecret'] ) )
        {
            $settings['accessToken']        = $accessTokenData['accessToken'] ;
            $settings['accessTokenSecret']  = $accessTokenData['accessTokenSecret'];
            $settings['accessTokenExpires'] = $accessTokenData['accessTokenExpires'];
        }

        $auth = \Mautic\Auth\ApiAuth::initiate( $settings );

        if( $auth->validateAccessToken() ) 
        {
            if( $auth->accessTokenUpdated() )
            {
                $accessTokenData = $auth->getAccessTokenData();
                /** @todo Save $accessTokenData */
                /** @todo Display success authorization message */
            } else {
                /** @todo Display info message that this app is already authorized. */
            }
        } else {
            /** @todo Display info message that the token is not valid. */
        }

        return $this->delegateView(
            array( 'contentTemplate' => 'BlocklistBundle:Main:main.html.php' )
        );
    }
}