<?php

class main2 extends app {

    public function __construct() {
        $this->extract($_GET);
        $this->url = urlencode("http://" . domain . "/");
        $this->twitter();
    }

    private function twitter() {
        $api_twitter = knife::open("http://search.twitter.com/search.atom?q=from:HeronSantosCom&rpp=1");
        if ($api_twitter) {
            $api_twitter = simplexml_load_string($api_twitter);
            $this->twitter = strip_tags((string) $api_twitter->entry->content[0]);
            $this->twitter_link = (string) $api_twitter->entry->link[0]["href"];
            $this->twitter_data = date("d/m H:i", strtotime((string) $api_twitter->entry->updated));
        }
    }

    public function email() {
        $this->extract($_POST);
        $email[] = "Nome: {$this->contact_name}";
        $email[] = "E-mail: {$this->contact_email}";
        $email[] = "Mensagem: {$this->contact_message}";
        $email[] = "";
        $email[] = "Data: " . date("r");
        $email[] = "IP: {$_SERVER["REMOTE_ADDR"]}";
        $name = htmlspecialchars($this->contact_name);
        $mailFrom = htmlspecialchars($this->contact_email);
        $subject = '[' . domain . '] Uma nova mensagem enviada pelo site!';
        $headers = "From: $name <$mailFrom>\n";
        $headers .= "Reply-To: $name <$mailFrom>\n";
        return mail('contato@heronsantos.com', $subject, htmlspecialchars(join("\n", $email)), $headers);
    }

}