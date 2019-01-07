<?php

class cart{
    
    /**
     * 
     * Initialisiert die Klasse Cart
     */
    public function initial_cart()
    {
        
        $cart = array();
        if(!isset($_SESSION['cart']))
        {
            $_SESSION['cart']=$cart;
        } 

    }

    
    
    /**
     * 
     * Fügt einen Artikel in das Array ein
     * @param unknown_type $Artikelnummer
     * @param unknown_type $Beschreibung
     * @param unknown_type $Verkäufer
     * @param unknown_type $Kosten
     * @param unknown_type $MwstSatz
     * @param unknown_type $MwSt
     * @param unknown_type $ZwischenSumme
     * @param unknown_type $Anzahl
     * @param unknown_type $gesammt
     */
    public function insertArtikel($MenuID,  $Name, $Anzahl, $Preis)
    {
        $Anzahl = "1";
        $Artikel = array($MenuID, $Name, $Anzahl, $Preis);
        $cart = $_SESSION['cart'];
        array_push($cart, $Artikel);
        $_SESSION['cart'] = $cart;
        
    }
    
    /**
     * 
     * Gibt Alle Artikel des Array in einer Tabelle aus.
     */
    public function getcart()
    {
        $Array = $_SESSION['cart'];
        echo "<table width='100%'>";
        echo "<tr><th>Gericht Nr.</th><th>Name</th><th>Anzahl</th><th>Preis</th></tr>";
        for($i = 0 ; $i < count($Array); $i++)
        {
            $innerArray = $Array[$i];
            
            echo "<tr>
            <td>$innerArray[0]</td>
            <td>$innerArray[1]</td>
            <td>$innerArray[2]</td>
            <td>$innerArray[3]</td>
            </tr>";
        }
        
        echo "</table>";
    }
    
    
    /**
     * 
     * Löscht den Waren Korb
     */
    public function undo_cart()
    {
        $_SESSION['cart'] = array();
    }
    
    
    /**
     * 
     * Gibt einen Datensatz Zurück
     * @param int $point
     */
    public function get_cartValue_at_Point($n)
    {
        
        $Array = $_SESSION['cart'];            
        return $Array[$n];
        
    }
    
    /**
     * 
     * Entfernt ein Artikel am Point n
     * @param int $point
     */
    public function delete_cartValue_at_Point($point)
    {
        $Array = $_SESSION['cart'];
        unset($Array[$point]);
    }
    
    /**
     * 
     * Gibt die Anzahl der Artikel zurück
     */
    public function get_cart_count()
    {
        return count($_SESSION['cart']);
    }
}





?>