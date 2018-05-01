<?php
	
	class assoc_array2xml {

    public $text;
    public $arrays, $keys, $node_flag, $depth, $xml_parser;

    public function array2xml($array)
    {
        $this->text="<?xml version=\"1.0\" encoding=\"utf-8\"?>\n<root>\n";
        $this->text.= $this->array_transform($array);
        $this->text .="\n</root>\n\n";

        return $this->text;
    }

    public function array_transform($array)
    {
        foreach($array as $key => $value)
        {
            if (!stristr($key, "weekday") AND !stristr($key, "week_abbr") AND !stristr($key, "week_letter") ) 
            	  $key = preg_replace("/_(\d+)/", "", $key);
        	
            if(!is_array($value))
            {
                $this->text .= "\t\t<$key>$value</$key>\n";
            }
            else
            {
            	$this->text.="\t<$key>\n";
                $this->array_transform($value);
                $this->text.="\t</$key>\n";
            }
        }

        return;
    }

    /*Transform an XML string to associative array "XML Parser Functions"*/
    public function xml2array($xml)
    {
        $this->depth=-1;
        $this->xml_parser = xml_parser_create();
        xml_set_object($this->xml_parser, $this);
        xml_parser_set_option ($this->xml_parser,XML_OPTION_CASE_FOLDING,0);//Don't put tags uppercase
        xml_set_element_handler($this->xml_parser, "startElement", "endElement");
        xml_set_character_data_handler($this->xml_parser,"characterData");
        xml_parse($this->xml_parser,$xml,true);
        xml_parser_free($this->xml_parser);
        return $this->arrays[0];
    }

    public function startElement($parser, $name, $attrs)
    {
        $this->keys[]=$name; //We add a key
        $this->node_flag=1;
        $this->depth++;
    }

    public function characterData($parser,$data)
    {
        $key=end($this->keys);
        $this->arrays[$this->depth][$key]=$data;
        $this->node_flag=0; //So that we don't add as an array, but as an element
    }

    public function endElement($parser, $name)
    {
        $key=array_pop($this->keys);
        //If $node_flag==1 we add as an array, if not, as an element
        if($this->node_flag==1)
        {
            $this->arrays[$this->depth][$key]=$this->arrays[$this->depth+1];
            unset($this->arrays[$this->depth+1]);
        }
        $this->node_flag=1;
        $this->depth--;
    }

}
?>