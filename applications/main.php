<?php

class main extends app {

    public function __construct() {
        $this->extract($_GET);
        if (!empty($_POST["submit"])) {
            $this->email();
        }
        $this->gravatar = knife::gravatar("contato@heronsantos.com", 326);
        $this->heronsantos = $this->thumb("http://www.heronsantos.com");
        $this->insigndigital = $this->thumb("http://www.insigndigital.com.br");
        $this->walterreisjr = $this->thumb("http://www.walterreisjr.com.br");
        $this->curteeu = $this->thumb("http://curte.eu");
        $this->pensamentosdiarios = $this->thumb("http://www.pensamentosdiarios.com.br");
        $this->versiculosdiarios = $this->thumb("http://www.versiculosdiarios.com.br");
        $this->illi = $this->thumb("http://www.illi.com.br");
        $this->phone2business = $this->thumb("http://www.phone2business.com");
        $this->trigger = $this->thumb("http://www.trigger.com.br");
    }

    private function thumb($site) {
        return "http://free.pagepeeker.com/v2/thumbs.php?size=l&code=916afea8d5&url={$site}";
    }

    public function email() {
        $this->extract($_POST);
        $this->contato_status = "Os campos solicitados não foram preenchidos corretamente!";
        if ($this->nome && $this->assunto && $this->mensagem && knife::is_mail($this->email)) {
            $email[] = "Nome: {$this->nome}";
            $email[] = "E-mail: {$this->email}";
            $email[] = "Assunto: {$this->assunto}";
            $email[] = "Mensagem: {$this->mensagem}";
            $email[] = "";
            $email[] = "Data: " . date("r");
            $email[] = "IP: {$_SERVER["REMOTE_ADDR"]}";
            $name = htmlspecialchars($this->nome);
            $mailFrom = htmlspecialchars($this->email);
            $subject = '[' . domain . '] Uma nova mensagem enviada pelo site!';
            $headers = "From: $name <$mailFrom>\n";
            $headers .= "Reply-To: $name <$mailFrom>\n";
            $this->contato_status = "Erro ao enviar a mensagem!";
            if (mail('contato@heronsantos.com', $subject, htmlspecialchars(join("\n", $email)), $headers)) {
                $this->contato_status = "Mensagem enviada com sucesso!";
            }
        }
    }

}