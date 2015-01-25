<?php

class RequestMethod
{
    public $ch = false;

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $this->ch = curl_init();
        $options = array(
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYHOST => 2,
        );

        curl_setopt_array($this->ch, $options);
    }

    /*
     *  Send $params to $url with POST request.
     *  If $redirect = true, it will also redirect to $url at the same time.
     */
    public function sendPost($url, $params, $redirect = false)
    {
        // Need redirect after post
        if ($redirect) {
            self::redirectForm($url, $params);
        } else {    // No nned to redirect

            if (false === $this->ch) {
                $this->init();
            }

            curl_setopt($this->ch, CURLOPT_URL, $url);
            curl_setopt($this->ch, CURLOPT_POST, 1);
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($params));

            $result = curl_exec($this->ch);
            curl_close($this->ch);

            return $result;
        }
    }

    /*
     *  json_encode $params and send it to $url with POST request.
     */
    public function sendJsonPost($url, $params)
    {
        if (false === $this->ch) {
            $this->init();
        }

        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($params));

        $result = curl_exec($this->ch);
        curl_close($this->ch);

        return $result;
    }

    /*
     * Send $params with html form and redirect to $url
     */
    public static function redirectForm($url, $params, $method = 'post')
    {
        $form = '<html>';
        $form .= '<head></head><body>';

        // Form 主體
        $form .= '<form id="form" name="form" action="' . htmlspecialchars($url) . '" method="' . htmlspecialchars($method) . '">';
        if (is_array($params)) {
            foreach ($params as $k => $v) {
                $form .= '<input type="hidden" name="' . htmlspecialchars($k) . '" value="' . htmlspecialchars($v) . '" />';
            }
        }
        $form .= '</form>';

        $form .= '</body>';
        $form .= '<script language="javascript">document.form.submit();</script>';
        $form .= '</html>';

        echo $form;
        exit;
    }

    /*
     *  Send GET request.
     *
     *  @Param [string] - $url
     *  @Param [array] - $params
     */
    public function sendGet($url, $params)
    {
        if (false === $this->ch) {
            $this->init();
        }

        curl_setopt($this->ch, CURLOPT_POST, false);
        curl_setopt($this->ch, CURLOPT_URL, $url . '?' . http_build_query($params));

        $result = curl_exec($this->ch);
        curl_close($this->ch);

        return $result;
    }

    /*
    * 導頁
    * @Params [string] $url
    * @Params [array] $params
    */
    public static function redirect($url, $params = null)
    {
        header("Status: 302 Found");

        if ($params) {
            header("Location: {$url}?" . http_build_query($params));
        } else {
            header("Location: {$url}");
        }

        exit;
    }
}
