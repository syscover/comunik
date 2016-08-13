<?php namespace Syscover\Comunik\Libraries;

use Illuminate\Http\Request;
use Syscover\Pulsar\Libraries\Miscellaneous;
use Syscover\Comunik\Models\Contact;

class ComunikLibrary
{
    /**
     * Function createContact
     *
     * Input names to create customer
     *
     * company_041 [company]
     * name_041 [name]
     * surname_041 [surname]
     * birth_date_041 [birthDate]
     * prefix_041 [prefix]
     * mobile_041 [mobile]
     * email_041 [email]
     * unsubscribe_mobile_041 [subscribeMobile]
     * unsubscribe_email_041 [subscribeEmail]
     *
     * @param   \Illuminate\Http\Request            $request
     * @return  \Syscover\Comunik\Models\Contact    $contact
     * @throws  \Exception
     */
    public static function createContact(Request $request)
    {
        if(! $request->has('country'))
            throw new \Exception('You have to define a country field to record a contact');

        $contact = Contact::create([
            'company_041'               => $request->has('company')? $request->input('company') : null,
            'name_041'                  => $request->has('name')? ucwords(strtolower($request->input('name'))) : null,
            'surname_041'               => $request->has('surname')? ucwords(strtolower($request->input('surname'))) : null,
            'birth_date_041'            => $request->has('birthDate')? \DateTime::createFromFormat(config('pulsar.datePattern'), $request->input('birthDate'))->getTimestamp() : null,
            'birth_date_text_041'       => $request->has('birthDate')? $request->input('birthDate') : null,
            'country_id_041'            => $request->input('country'),
            'prefix_041'                => $request->has('prefix')? $request->input('prefix') : null,
            'mobile_041'                => $request->has('mobile')? $request->input('mobile') : null,
            'email_041'                 => $request->has('email')? strtolower($request->input('email')) : null,
            'unsubscribe_mobile_041'    => $request->has('subscribeMobile') && $request->input('subscribeMobile') != '1'? false : true,
            'unsubscribe_email_041'     => $request->has('subscribeEmail') && $request->input('subscribeEmail') != '1'? false : true
        ]);

        return $contact;
    }

    /**
     * Function updateContact
     *
     * Input names to create customer
     *
     * company_041 [company]
     * name_041 [name]
     * surname_041 [surname]
     * birth_date_041 [birthDate]
     * prefix_041 [prefix]
     * mobile_041 [mobile]
     * email_041 [email]
     * unsubscribe_mobile_041 [subscribeMobile]
     * unsubscribe_email_041 [subscribeEmail]
     *
     * @param   \Illuminate\Http\Request            $request
     * @return  \Syscover\Comunik\Models\Contact    $contact
     * @throws  \Exception
     */
    public static function updateContact(Request $request)
    {
        if(! $request->has('id'))
            throw new \Exception('You have to indicate a id contact');

        if(! $request->has('country'))
            throw new \Exception('You have to define a country field to record a contact');

        Contact::where('id_041', $request->input('id'))->update([
            'company_041'               => $request->has('company')? $request->input('company') : null,
            'name_041'                  => $request->has('name')? ucwords(strtolower($request->input('name'))) : null,
            'surname_041'               => $request->has('surname')? ucwords(strtolower($request->input('surname'))) : null,
            'birth_date_041'            => $request->has('birthDate')? \DateTime::createFromFormat(config('pulsar.datePattern'), $request->input('birthDate'))->getTimestamp() : null,
            'birth_date_text_041'       => $request->has('birthDate')? $request->input('birthDate') : null,
            'country_id_041'            => $request->input('country'),
            'prefix_041'                => $request->has('prefix')? $request->input('prefix') : null,
            'mobile_041'                => $request->has('mobile')? $request->input('mobile') : null,
            'email_041'                 => $request->has('email')? strtolower($request->input('email')) : null,
            'unsubscribe_mobile_041'    => $request->has('subscribeMobile') && $request->input('subscribeMobile') != '1'? false : true,
            'unsubscribe_email_041'     => $request->has('subscribeEmail') && $request->input('subscribeEmail') != '1'? false : true
        ]);

        $contact = Contact::builder()->find($request->input('id'));

        if($contact === null)
            throw new \Exception('You have to indicate an id of a existing contact');

        return $contact;
    }

    /**
     * Function to get default email header
     *
     * @access  public
     * @param   \Illuminate\Http\Request    $request
     * @param   array                       $parameters
     * @return  array
     */
    public static function setMailingLinks($request, $parameters)
    {
        // check if header is include inside body field
        if($request->has('theme') && $request->input('header') == "" && strpos($request->input('body'), "<!DOCTYPE html") === false)
        {
            $response['header'] =   self::getHeader(public_path() . config('comunik.themesFolder') . $request->input('theme') . '/header.html');
        }
        else
        {
            $response['header'] = $request->input('header');
        }

        // check if include html link
        if($request->has('setHtmlLink'))
        {
            $response['body'] = self::setHtmlLink($request, $request->input('body'));
        }
        else
        {
            $response['body'] = $request->input('body');
        }

        // check if include unsubscribe link
        if($request->has('setUnsubscribeLink'))
        {
            $response['body'] = self::setUnsubscribe($request, $response['body']);
        }

        // check if include track pixel
        if($request->has('setTrackPixel'))
        {
            $response['body'] = self::setTrackingPixel($request, $response['body']);
        }

        // check if footer is include inside body field
        if($request->has('theme') && $request->input('footer') == "" && strpos($request->input('body'), "</html>") === false)
        {
            $response['footer'] = self::getFooter(public_path() . config('comunik.themesFolder') . $request->input('theme') . '/footer.html');
        }
        else
        {
            $response['footer'] = $request->input('footer');
        }

        // convert html to text, to send text version email
        $response['text'] = self::htmlToText($response['header'] . $response['body'] . $response['footer']);

        return $response;
    }

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
        $htmlLink = str_replace("#link#", route('previewComunikEmailCampaign', ['campaign' => '#campaign#', 'historyId' => '#historyId#']), $request->input('htmlLink'));

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
        $unsubscribeLink = str_replace("#unsubscribe#", route('getUnsubscribeComunikContact', ['contactKey' => '#contactKey#']), $request->input('unsubscribeLink'));

        $piece = '<table align="center" cellpadding="0" cellspacing="0" border="0"><tr><td style="font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;padding-top: 10px;padding-bottom: 10px;">'
            . $unsubscribeLink .
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

        $indexBodyTag = strpos($html, '</body>');

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

        // TODO: comprobar validez de este apaño
        // process entity
        libxml_use_internal_errors(true);

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
    protected static function fixNewlines($text)
    {
        // replace \r\n to \n
        $text = str_replace("\r\n", "\n", $text);
        // remove \rs
        $text = str_replace("\r", "\n", $text);

        return $text;
    }

    protected static function nextChildName($node)
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

    protected static function prevChildName($node)
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

    protected static function iterateOverNode($node)
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

    /**
     * Function to search pattern inside message
     * @param $message
     * @param $patterns
     * @return array
     */
    public static function checkEmailPattern($message, $patterns)
    {
        $response       = [];
        $patternFound   = false;
        $objPattern     = null;
        $subject        = $message->getSubject();
        $body           = $message->getMessageBody();


        foreach($patterns as $pattern)
        {
            $subjectFound = false;
            $messageFound = false;

            if(empty($pattern->subject_049) == false && strpos($subject, $pattern->subject_049) !== false)
                $subjectFound = true;

            if(empty($pattern->message_049) === false && strpos($body, $pattern->message_049) !== false)
                $messageFound = true;

            if($pattern->operator_049 == 'and' && $subjectFound && $messageFound)
            {
                $patternFound   = true;
                $objPattern     = $pattern;
                break;
            }
            elseif(($pattern->operator_049 == 'or' || $pattern->operator_049 == null) && ($subjectFound || $messageFound))
            {
                $patternFound   = true;
                $objPattern     = $pattern;
                break;
            }
        }

        if($patternFound)
        {
            $response['success']    = true;
            $response['pattern']    = $objPattern;
            $emails                 = Miscellaneous::extractEmail($body);
            $response['contacts']   = Contact::builder()
                ->whereIn('email_041', $emails)
                ->where('unsubscribe_email_041', false)
                ->get();
        }
        else
        {
            $response['success']    = false;
            $response['pattern']    = false;
            $emails                 = Miscellaneous::extractEmail($body);
            $response['contacts']   = Contact::builder()
                ->whereIn('email_041', $emails)
                ->where('unsubscribe_email_041', false)
                ->get();
        }

        return $response;
    }
}