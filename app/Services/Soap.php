<?php

namespace App\Services;

class Soap {

    private static $SConnection;
    private static $ItemsArray = array();

    private static function CreateConnection()
    {
        Soap::$SConnection = new \SoapClient(null, array(
            'location'      =>  'http://' . env('SOAP_HOST') .':' . env('SOAP_PORT') . '/',
            'uri'           =>  'urn:TC',
            'user_agent'    =>  'trinitycore',
            'style'         =>  SOAP_RPC,
            'login'         =>  env('SOAP_USERNAME'),
            'password'      =>  env('SOAP_PASSWORD'),
            'trace'         =>  1,
            'exceptions'    => 0
        ));
    }

    private static function CloseConnection()
    {
        Soap::$SConnection = null;
    }

    private static function Execute($Command)
    {
        Soap::CreateConnection();
        $Result = Soap::$SConnection->executeCommand(new \SoapParam($Command, 'command'));
        Soap::CloseConnection();
        Soap::FlushItemsArray();
        if(is_soap_fault($Result))
            return false;
        else
            return true;
    }

    public static function AddItemToList($ItemID, $ItemCount)
    {
        Soap::$ItemsArray[] = array('id' => $ItemID, 'count' => $ItemCount);
    }

    private static function FlushItemsArray()
    {
        Soap::$ItemsArray = array();
    }

    public static function levelUp($characters) {
        $Command = '.character level '.$characters .' 50';
        if(Soap::Execute($Command))
            return true;
        else
            return false;
    }

    public static function SendItem($PlayerName, $Subject)
    {
        $Command = '.send items '.$PlayerName.' "'.$Subject.'" "'.Soap::BuildMessageBody($PlayerName, $Subject).'" ';
        $ItemsString = '';
        foreach(Soap::$ItemsArray as $Item)
            $ItemsString .= $Item['id'].':'.$Item['count'].' ';
        $Command = $Command.$ItemsString;
        if(Soap::Execute($Command))
            return true;
        else
            return false;
    }

    private static function BuildMessageBody($PlayerName, $Subject)
    {
        $MessageBody = '';
        $MessageBody .= $PlayerName.",\n\n";
        $MessageBody .= 'Thanks for your purchase of '.$Subject."\n\n";
        $MessageBody .= '';

        return $MessageBody;
    }

    public static function SendMoney($PlayerName, $Subject, $Text, $Money)
    {
        $Command = '.send money '.$PlayerName.' "'.$Subject.'" "'.$Text.'" '.$Money;
        Soap::Execute($Command);
    }
}

?>