<?php

class all2e1PixelOutMp3FlashPlayerOperators
{
    /*!
     Constructor
    */
    function all2e1PixelOutMp3FlashPlayerOperators()
    {
        $this->Operators = array('mp3player');
    }

    /*!
     Returns the operators in this class.
    */
    function &operatorList()
    {
        return $this->Operators;
    }

    /*!
     \return true to tell the template engine that the parameter list
    exists per operator type, this is needed for operator classes
    that have multiple operators.
    */
    function namedParameterPerOperator()
    {
        return true;
    }

    /*!
     The first operator has two parameters, the other has none.
     See eZTemplateOperator::namedParameterList()
    */
    function namedParameterList()
    {
        return array( 'mp3player' => array('url' => array( 'type' => 'string',
                                                           'required' => true,
                                                           'default' => '' ),
                                           'id' => array( 'type' => 'string',
                                                          'required' => false,
                                                          'default' => '' )
                                            )
                  );
    }

    /*!
     Executes the needed operator(s).
     Checks operator names, and calls the appropriate functions.
    */
    function modify( &$tpl, &$operatorName, &$operatorParameters, &$rootNamespace,
                     &$currentNamespace, &$operatorValue, &$namedParameters )
    {
        switch ( $operatorName )
        {
            case 'mp3player':
            {
                $operatorValue = $this->mp3player( $namedParameters['url'], $namedParameters['id'] );
            } break;
        }
    }

    function mp3player( $url, $id )
    {
        $ini = eZINI::instance( 'all2e1pixeloutmp3flashplayer.ini' );
    
        $playerLocation = '/extension/all2e1pixeloutmp3flashplayer/design/standard/flash/player.swf';
        $url = trim($url, '"');
        
        $returnArray = array('<object type="application/x-shockwave-flash" data="'.$playerLocation.'" id="audioplayer'.$id.'" height="'.$ini->variable( 'FunctionalOptions','height' ).'" width="'.$ini->variable( 'FunctionalOptions','width' ).'">');
        array_push($returnArray, '<param name="movie" value="'.$playerLocation.'" />');
        array_push($returnArray, '<param name="FlashVars" value="playerID='.$id.'&amp;soundFile='.$url.'&autostart='.$ini->variable( 'FunctionalOptions','autostart' ).'&loop='.$ini->variable( 'FunctionalOptions','loop' ).'&bg=0x'.$ini->variable( 'DesignSettings','bg' ).'&leftbg=0x'.$ini->variable( 'DesignSettings','leftbg' ).'&rightbg=0x'.$ini->variable( 'DesignSettings','rightbg' ).'&rightbghover=0x'.$ini->variable( 'DesignSettings','rightbghover' ).'&lefticon=0x'.$ini->variable( 'DesignSettings','lefticon' ).'&righticon=0x'.$ini->variable( 'DesignSettings','righticon' ).'&righticonhover=0x'.$ini->variable( 'DesignSettings','righticonhover' ).'&text=0x'.$ini->variable( 'DesignSettings','text' ).'&slider=0x'.$ini->variable( 'DesignSettings','slider' ).'&loader=0x'.$ini->variable( 'DesignSettings','loader' ).'&track=0x'.$ini->variable( 'DesignSettings','track' ).'&border=0x'.$ini->variable( 'DesignSettings','border' ).'" />');
        array_push($returnArray, '<param name="quality" value="high" />');
        array_push($returnArray, '<param name="menu" value="false" />');
        array_push($returnArray, '<param name="wmode" value="transparent" />');
        array_push($returnArray, '</object>');

        return implode('', $returnArray);
    }

    /// \privatesection
    var $Operators;
}

?>
