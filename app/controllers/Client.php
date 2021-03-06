<?php

session_start();

//controller de client
class Client extends Controller
{
    public static function index()
    {
        parent::view("index");
    }

    //appel AddTokenToUser
    public static function AddToken()
    {
        if ($_POST["Action"] > 0) {
            parent::model("BD");
            echo BD::AddTokenToUser($_SESSION["client"], $_POST["Action"]);
        }
        else
            parent::view("index");
    }

    //appel GetToken
    public static function GetToken()
    {
        if($_POST["Action"] == "getToken")
        {
            parent::model("BD");
            $nbToken = BD::GetToken($_SESSION["client"]);
            echo json_encode($nbToken);
        }
        else
            parent::view("index");
    }

    //appel GetFutureHome
    public static function GetFutureHome()
    {
        if(isset($_POST["Action"]))
        {
            parent::model("BD");
            $result = BD::GetFutureHome();
            echo json_encode($result);
        }
        else
            parent::view("index");
    }

    //appel GetFutureVisitor
    public static function GetFutureVisitor()
    {
        if(isset($_POST["Action"]))
        {
            parent::model("BD");
            $result = BD::GetFutureVisitor();
            echo json_encode($result);
        }
        else
            parent::view("index");
    }

    //appel CalculateGains
    public static function CalculateGains()
    {
        if(isset($_POST["Action"]))
        {
            parent::model("BD");
            $data = explode(';', $_POST["Action"]);
            $result = BD::CalculateGains($data[0], $data[1], $data[2]);
            echo json_encode($result);
            //echo $data[1];
        }
        else
            parent::view("index");
    }

    //appel PlaceBet
    public static function PlaceBet()
    {
        if(isset($_POST["Action"]))
        {
            parent::model("BD");
            $data = explode(';', $_POST["Action"]);
            $result = BD::PlaceBet($_SESSION["client"], $data[0], $data[1], $data[2], $data[3]);
            echo json_encode($result);
        }
        else
            parent::view("index");
    }

    //verifie que t'utilisateur peut acceder a la vue de client
    public static function BetStand()
    {
        if(isset($_SESSION["client"]))
        {
            parent::view("ClientHome");
        }
        else
            parent::view("index");
    }

    //verifie que l'utilisateur peut acceder a la vue de BetInfo
    public static function BetInfoPage()
    {
        if(isset($_SESSION["client"]))
        {
            parent::view("BetInfo");
        }
        else
            parent::view("index");
    }

    //appel CurrentBet
    public static function BetInfoCurrent()
    {
        if(isset($_SESSION["client"]))
        {
            parent::model("BD");
            $result = BD::CurrentBet($_SESSION["client"]);
            echo json_encode($result);
        }
        else
            parent::view("index");
    }

    //appel DeleteBet
    public static function DeleteBet()
    {
        if(isset($_POST["Action"]))
        {
            parent::model("BD");
            $result = BD::DeleteBet($_POST["Action"]);
            echo json_encode($result);
        }
        else
            parent::view("index");
    }
}