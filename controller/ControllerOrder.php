<?php

require_once File::build_path(array('model', 'ModelOrder.php'));

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerOrder
 *
 * @author Titil
 */
class ControllerOrder {
       
    public static function create() {
        if (Session::is_connected()) {
            if( Panier::countArticles() > 0){

                $bDate = date('Y/m/d');
                $state = "En cours";
                $nickName = $_SESSION['nickName'];
                $price = Panier::totalPrice();
                $data = array(
                   'nickName' => $nickName,
                   'date' => $bDate,
                   'state' => $state,
                   'price' => $price
                );

                $order = ModelOrder::save($data);
                $idOrder = ModelOrder::getLastOrder($nickName);
                $articles = Panier::saveArticles($idOrder);
                if($order && $articles){
                    echo "La commande a été effectuée avec succès. ";
                }
                else{
                    echo "Problème lors de l'enregistrement de votre commande. <br> Si le problème persiste, merci de bien vouloir prévenir l'administrateur du site. ";
                }
                self::readAll();
            }
            else{
                echo "Votre panier est vide. Pour commander, veuillez ajouter des articles à votre panier. ";
                ControllerProduct::viewPanier();
            }
        } else {
            $_SESSION['orderCommand'] = true;
            echo "Pour passer une commande, veuillez vous enregistrez. ";
            ControllerUser::connect();
        }
    }
    public static function readAll() {
        if(Session::is_connected()){
            $data = array(
                "nickName" => $_SESSION['nickName']
            );
            $tab_p = ModelOrder::selectAllByUserName($data);
            if(empty($tab_p)){
                $msg = "Vous n'avez aucune commande en cours ou terminées";
            }
            $view = 'displayAllOrder';
            $controller = 'order';
            $pagetitle = 'Historique des commandes';

            require File::build_path(array('view', 'view.php'));
        }
        else{
            $data = array();
            $data['error'] = "Vous n'avez pas la permission pour accéder à ce contenu";
            $data['view'] = 'error';
            $data['controller'] = 'default';
            ControllerDefault::error($data);
        }
    }
    public static function read() {
        $idOrder = $_GET['idOrder'];
        $p = ModelOrder::select($idOrder);
        
        if($p != false){
            $data = array(
              'idOrder' => $p->getIDOrder()  
            );
            //On récupère le contenu de la commande
            $tab_p = ModelOrderContent::selectAllProduct($data);

            $view = 'displayOrder';
            $controller = 'order';
            $pagetitle = 'Détail de la commande ' . $idOrder;
            require File::build_path(array('view', 'view.php'));
        }else{
            $data = array();
            $data['error'] = "Erreur, la commande " . $idOrder . " n'existe pas. ";
            $data['view'] = 'error';
            $data['controller'] = 'default';
            ControllerDefault::error($data); 
        }
    }
}
