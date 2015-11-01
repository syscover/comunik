<?php namespace Syscover\Comunik\Libraries;

use Syscover\Pulsar\Libraries\Miscellaneous as MiscellaneousPulsar;
use Syscover\Comunik\Models\PatternEmail;
use Syscover\Comunik\Models\Contacto;

class Miscellaneous
{
    /**
     * Function to get default email header
     *
     * @access  public
     * @param   string $path
     * @return  string
     * @throws  \Exception
     */
    public static function getEmlHeaders($path = null)
    {
        if($path === null)
        {
            $path  = public_path() . '/packages/syscover/comunik/email/templates/headers.eml';
        }

        if (file_exists ($path))
        {
            $emlHeaders = file_get_contents($path);
            return $emlHeaders;
        }
        else
        {
            throw new \Exception('eml headers not found. Check if exist the file: '.$path);
        }
    }


    /**
     * Function to get default html email header
     *
     * @access  public
     * @param   string $path
     * @return  string
     * @throws  \Exception
     */
    public static function getHeader($path)
    {
        if(file_exists($path))
        {
            $header = file_get_contents($path);

            return $header;
        }
        else
        {
            throw new \Exception('HTML header not found.Check if exist the file: '.$path);
        }
    }

    /**
     * Function to get default html email footer
     *
     * @access  public
     * @param   string $path
     * @return  string
     * @throws  \Exception
     */
    public static function getFooter($path)
    {
        if(file_exists($path))
        {
            $footer = file_get_contents($path);
            return $footer;
        }
        else
        {
            throw new \Exception('HTML footer not found. Please, check if exist the file: '.$path);
        }
    }

    /**
     * Function to get themes to content builder
     *
     * @access  public
     * @param   string $path
     * @return  string
     * @throws  \Exception
     */
    public static function getThemes($path = null)
    {
        if($path === null)
        {
            $path  = public_path() . config('comunik.themesFolder');
        }

        if (is_dir($path))
        {
            $themes = [];
            if ($rsc = opendir($path))
            {
                while (($file = readdir($rsc)) !== false)
                {
                    if (is_dir($path . $file) && $file != "." && $file != ".." && file_exists ($path . $file . '/settings.json'))
                    {
                        $settings = json_decode(file_get_contents($path . $file . '/settings.json'));
                        $themes[] = $settings;
                    }
                }
                closedir($rsc);
            }
            return $themes;
        }
        return false;
    }

    /**
     * Function to insert link to show online
     *
     * @access  public
     * @param   \Illuminate\Http\Request    $request
     * @param   string                      $html
     * @return  string
     */
    public static function setHtmlLink($request, $html)
    {
        // create link
        $htmlLink = str_replace("#link#", route('showComunikEmailCampaign', ['campaign' => '#campaign#', 'contact' => '#contact#']), $request->input('htmlLink'));

        $piece = '<table align="center" cellpadding="0" cellspacing="0" border="0"><tr><td style="font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;padding-top: 10px;padding-bottom: 10px;">'
            . $htmlLink .
            '</td></tr></table>';

        $indexBodyTag = strpos($html, "<body");

        if($indexBodyTag === false)
        {
            $html = $piece . $html;
        }
        else
        {
            for ($i = $indexBodyTag; $i < strlen($html); $i++)
            {
                if ($html[$i] == ">")
                {
                    $indexEndBodyTag = $i;
                    $i = strlen($html);
                }
            }
            $html = substr_replace($html, $piece, $indexEndBodyTag + 1, 0);
        }

        return $html;
    }

    /**
     * Function to insert link to unsubscribe
     *
     * @access  public
     * @param   \Illuminate\Http\Request    $request
     * @param   string                      $html
     * @return  string
     */
    public static function setUnsubscribe($request, $html)
    {
        // create link
        $unsubscribe = str_replace("#unsubscribe#", route('showUnsubscribeComunikContact', ['contact' => '#contact#']), $request->input('unsubscribe'));

        $piece = '<table align="center" cellpadding="0" cellspacing="0" border="0"><tr><td style="font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;padding-top: 10px;padding-bottom: 10px;">'
            . $unsubscribe .
            '</td></tr></table>';

        $indexBodyTag = strpos($html, "</body>");

        if($indexBodyTag === false)
        {
            $html = $html . $piece;
        }
        else
        {
            $html = substr_replace($html, $piece, $indexBodyTag, 0);
        }

        return $html;
    }

    /**
     * Function to insert tracking pixel
     *
     * @access  public
     * @param   \Illuminate\Http\Request    $request
     * @param   string                      $html
     * @return  string
     */
    public static function setTrackingPixel($request, $html)
    {
        $trackPixel = $request->input('trackPixel');

        $indexBodyTag = strpos($html, "</body>");

        if($indexBodyTag === false)
        {
            $html = $html . $trackPixel;
        }
        else
        {
            $html = substr_replace($html, $trackPixel, $indexBodyTag, 0);
        }

        return $html;
    }


















    /*
     *  Función busca una coincidencia con los patrones de emails para detectar correos rebotados
     *
     * @access	public
     * @return	array
     */
    public static function checkEmailPattern($message, $patterns)
    {
        $response = array();

        $matchPattern   = false;
        $objPattern     = null;
        $subject        = $message->getSubject();
        $body           = $message->getMessageBody();

        // Proceso de comprobación de patrones
        foreach($patterns as $pattern)
        {
            $matchSubject = false;
            $matchMessage = false;

            if(empty($pattern->subject_079) == false && strpos($subject, $pattern->subject_079) !== false)
            {
                $matchSubject = true;
            }

            if(empty($pattern->message_079) === false && strpos($body, $pattern->message_079) !== false)
            {
                $matchMessage = true;
            }

            if($pattern->summation_079 == 'AND' && $matchSubject && $matchMessage)
            {
                $matchPattern   = true;
                $objPattern     = $pattern;
                break;
            }
            elseif(($pattern->summation_079 == 'OR' || $pattern->summation_079 == null) && ($matchSubject || $matchMessage))
            {
                $matchPattern   = true;
                $objPattern     = $pattern;
                break;
            }
        }

        if($matchPattern)
        {
            $response['success']    = true;
            $response['pattern']    = $objPattern;
            $emails                 = MiscellaneousPulsar::extractEmail($body);
            $response['contactos']  = Contacto::getContactosFromEmailsNotUnsuscribe($emails);
        }
        else
        {
            $response['success']    = false;
            $response['pattern']    = false;
            $emails                 = MiscellaneousPulsar::extractEmail($body);
            $response['contactos']  = Contacto::getContactosFromEmailsNotUnsuscribe($emails);
        }

        return $response;
    }


    /**
     * Function to convert html to text
     *
     * @access  public
     * @param   string $html
     * @return  string
     * @throws \Exception
     */
    public static function htmlToText($html)
    {
        $html = self::fixNewlines($html);

        $doc = new \DOMDocument();

        if (!$doc->loadHTML($html))
            throw new \Exception("Could not load HTML - badly formed?", $html);

        $output = self::iterateOverNode($doc);

        // remove leading and trailing spaces on each line
        $output = preg_replace("/[ \t]*\n[ \t]*/im", "\n", $output);

        // remove leading and trailing whitespace
        $output = trim($output);

        return $output;
    }

    /**
     * Unify newlines; in particular, \r\n becomes \n, and
     * then \r becomes \n. This means that all newlines (Unix, Windows, Mac)
     * all become \ns.
     *
     * @param   string $text text with any number of \r, \r\n and \n combinations
     * @return  string the fixed text
     */
    private static function fixNewlines($text)
    {
        // replace \r\n to \n
        $text = str_replace("\r\n", "\n", $text);
        // remove \rs
        $text = str_replace("\r", "\n", $text);

        return $text;
    }

    private static function nextChildName($node)
    {
        // get the next child
        $nextNode = $node->nextSibling;
        while ($nextNode != null)
        {
            if ($nextNode instanceof \DOMElement)
            {
                break;
            }
            $nextNode = $nextNode->nextSibling;
        }
        $nextName = null;
        if ($nextNode instanceof \DOMElement && $nextNode != null)
        {
            $nextName = strtolower($nextNode->nodeName);
        }

        return $nextName;
    }

    private static function prevChildName($node)
    {
        // get the previous child
        $nextNode = $node->previousSibling;
        while ($nextNode != null)
        {
            if ($nextNode instanceof \DOMElement)
            {
                break;
            }
            $nextNode = $nextNode->previousSibling;
        }
        $nextName = null;
        if ($nextNode instanceof \DOMElement && $nextNode != null)
        {
            $nextName = strtolower($nextNode->nodeName);
        }

        return $nextName;
    }

    private static function iterateOverNode($node)
    {
        if ($node instanceof \DOMText)
        {
            // Replace whitespace characters with a space (equivilant to \s)
            return preg_replace("/[\\t\\n\\f\\r ]+/im", " ", $node->wholeText);
        }
        if ($node instanceof \DOMDocumentType)
        {
            // ignore
            return "";
        }

        $nextName = self::nextChildName($node);
        $prevName = self::prevChildName($node);

        $name = strtolower($node->nodeName);

        // start whitespace
        switch ($name)
        {
            case "hr":
                return "------\n";

            case "style":
            case "head":
            case "title":
            case "meta":
            case "script":
                // ignore these tags
                return "";

            case "h1":
            case "h2":
            case "h3":
            case "h4":
            case "h5":
            case "h6":
                // add two newlines
                $output = "\n";
                break;

            case "p":
            case "div":
                // add one line
                $output = "\n";
                break;

            default:
                // print out contents of unknown tags
                $output = "";
                break;
        }

        // debug
        //$output .= "[$name,$nextName]";

        if (isset($node->childNodes))
        {
            for ($i = 0; $i < $node->childNodes->length; $i++)
            {
                $n = $node->childNodes->item($i);

                $text = self::iterateOverNode($n);

                $output .= $text;
            }
        }

        // end whitespace
        switch ($name)
        {
            case "style":
            case "head":
            case "title":
            case "meta":
            case "script":
                // ignore these tags
                return "";

            case "h1":
            case "h2":
            case "h3":
            case "h4":
            case "h5":
            case "h6":
                $output .= "\n";
                break;

            case "p":
            case "br":
                // add one line
                if ($nextName != "div")
                    $output .= "\n";
                break;

            case "div":
                // add one line only if the next child isn't a div
                if ($nextName != "div" && $nextName != null)
                    $output .= "\n";
                break;

            case "a":
                // links are returned in [text](link) format
                $href = $node->getAttribute("href");
                if ($href == null)
                {
                    // it doesn't link anywhere
                    if ($node->getAttribute("name") != null)
                    {
                        $output = "[$output]";
                    }
                }
                else
                {
                    if ($href == $output || $href == "mailto:$output" || $href == "http://$output" || $href == "https://$output")
                    {
                        // link to the same address: just use link
                        $output;
                    }
                    else
                    {
                        // replace it
                        $output = "[$output]($href)";
                    }
                }

                // does the next node require additional whitespace?
                switch ($nextName)
                {
                    case "h1": case "h2": case "h3": case "h4": case "h5": case "h6":
                    $output .= "\n";
                    break;
                }

            default:
                // do nothing
        }

        return $output;
    }
}