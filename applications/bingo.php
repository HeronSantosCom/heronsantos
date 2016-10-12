<?php

class bingo {

    public function sorteio() {
        $objetos = array(
            "fralda P",
            "fralda M",
            "fralda G",
            "coador e funil",
            "chuquinha",
            "mordedor",
            "brinquedo para banho",
            "porta leite em pó",
            "conjunto de pente e escova",
            "álcool 70%",
            "lenço umedecido",
            "kit manicure",
            "algodão",
            "cotonetes",
            "luva e meia",
            "aspirador nasal",
            "fraldas de pano",
            "cabides",
            "lençol para carrinho",
            "lençol para berço",
            "babador",
            "papeiro",
            "mijão",
            "cueiro",
            "pano de boca",
            "camisa",
            "cobertor",
            "bodie",
            "sabonetes",
            "toalha fralda",
            "pinça higiênica",
            "pomada anti assaduras"
        );

        $cartelas = array();
        for ($cartela = 1; $cartela <= 60; $cartela++) {
            $itens = array();
            for ($item = 0; $item < 8; $item++) {
                print ">>>>>>>> {$cartela} / {$item}";
                $sorte2 = rand(0, count($objetos) - 1);
                if (in_array($sorte2, $itens)) {
                    $item--;
                    print " - falhou";
                } else {
                    $itens[$item] = $sorte2;
                }
                print "\n";
            }
            $hash = $itens;
            sort($hash);
            $hash = join(",", $hash);
            print ">>>> {$cartela}";
            if ($this->check($cartelas, $hash)) {
                $cartela--;
                print " - falhou";
            } else {
                $cartelas[$cartela]["keys"] = $itens;
                $cartelas[$cartela]["itens"] = $hash;
            }
            print "\n";
        }
        print "\n";
        foreach ($cartelas as $cartela => $itens) {
            print "{$cartela};{$itens["itens"]}\n";
        }
        print "\n";
        foreach ($cartelas as $cartela => $itens) {
            print $cartela;
            foreach ($itens["keys"] as $key) {
                print ";{$objetos[$key]}";
            }
            print "\n";
        }
    }

    private function check($cartelas, $hash) {
        foreach ($cartelas as $itens) {
            if ($itens["itens"] == $hash) {
                return true;
            }
        }
        return false;
    }

}