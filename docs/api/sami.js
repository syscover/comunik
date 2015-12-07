
(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href=".html">Syscover</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Syscover_Comunik" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Syscover/Comunik.html">Comunik</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Syscover_Comunik_Controllers" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Syscover/Comunik/Controllers.html">Controllers</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Syscover_Comunik_Controllers_ContactsController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Comunik/Controllers/ContactsController.html">ContactsController</a>                    </div>                </li>                            <li data-name="class:Syscover_Comunik_Controllers_EmailCampaignsController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Comunik/Controllers/EmailCampaignsController.html">EmailCampaignsController</a>                    </div>                </li>                            <li data-name="class:Syscover_Comunik_Controllers_EmailPreferenceController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Comunik/Controllers/EmailPreferenceController.html">EmailPreferenceController</a>                    </div>                </li>                            <li data-name="class:Syscover_Comunik_Controllers_EmailTemplatesController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Comunik/Controllers/EmailTemplatesController.html">EmailTemplatesController</a>                    </div>                </li>                            <li data-name="class:Syscover_Comunik_Controllers_GroupsController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Comunik/Controllers/GroupsController.html">GroupsController</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:Syscover_Comunik_Libraries" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Syscover/Comunik/Libraries.html">Libraries</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Syscover_Comunik_Libraries_Cron" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Comunik/Libraries/Cron.html">Cron</a>                    </div>                </li>                            <li data-name="class:Syscover_Comunik_Libraries_Miscellaneous" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Comunik/Libraries/Miscellaneous.html">Miscellaneous</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:Syscover_Comunik_Models" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Syscover/Comunik/Models.html">Models</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Syscover_Comunik_Models_Contact" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Comunik/Models/Contact.html">Contact</a>                    </div>                </li>                            <li data-name="class:Syscover_Comunik_Models_EmailCampaign" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Comunik/Models/EmailCampaign.html">EmailCampaign</a>                    </div>                </li>                            <li data-name="class:Syscover_Comunik_Models_EmailSendHistorical" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Comunik/Models/EmailSendHistorical.html">EmailSendHistorical</a>                    </div>                </li>                            <li data-name="class:Syscover_Comunik_Models_EmailSendQueue" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Comunik/Models/EmailSendQueue.html">EmailSendQueue</a>                    </div>                </li>                            <li data-name="class:Syscover_Comunik_Models_EmailTemplate" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Comunik/Models/EmailTemplate.html">EmailTemplate</a>                    </div>                </li>                            <li data-name="class:Syscover_Comunik_Models_Group" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Comunik/Models/Group.html">Group</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:Syscover_Comunik_ComunikServiceProvider" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Syscover/Comunik/ComunikServiceProvider.html">ComunikServiceProvider</a>                    </div>                </li>                </ul></div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "Syscover.html", "name": "Syscover", "doc": "Namespace Syscover"},{"type": "Namespace", "link": "Syscover/Comunik.html", "name": "Syscover\\Comunik", "doc": "Namespace Syscover\\Comunik"},{"type": "Namespace", "link": "Syscover/Comunik/Controllers.html", "name": "Syscover\\Comunik\\Controllers", "doc": "Namespace Syscover\\Comunik\\Controllers"},{"type": "Namespace", "link": "Syscover/Comunik/Libraries.html", "name": "Syscover\\Comunik\\Libraries", "doc": "Namespace Syscover\\Comunik\\Libraries"},{"type": "Namespace", "link": "Syscover/Comunik/Models.html", "name": "Syscover\\Comunik\\Models", "doc": "Namespace Syscover\\Comunik\\Models"},
            
            {"type": "Class", "fromName": "Syscover\\Comunik", "fromLink": "Syscover/Comunik.html", "link": "Syscover/Comunik/ComunikServiceProvider.html", "name": "Syscover\\Comunik\\ComunikServiceProvider", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Comunik\\ComunikServiceProvider", "fromLink": "Syscover/Comunik/ComunikServiceProvider.html", "link": "Syscover/Comunik/ComunikServiceProvider.html#method_boot", "name": "Syscover\\Comunik\\ComunikServiceProvider::boot", "doc": "&quot;Bootstrap the application services.&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\ComunikServiceProvider", "fromLink": "Syscover/Comunik/ComunikServiceProvider.html", "link": "Syscover/Comunik/ComunikServiceProvider.html#method_register", "name": "Syscover\\Comunik\\ComunikServiceProvider::register", "doc": "&quot;Register the application services.&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Comunik\\Controllers", "fromLink": "Syscover/Comunik/Controllers.html", "link": "Syscover/Comunik/Controllers/ContactsController.html", "name": "Syscover\\Comunik\\Controllers\\ContactsController", "doc": "&quot;Class ContactsController&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\ContactsController", "fromLink": "Syscover/Comunik/Controllers/ContactsController.html", "link": "Syscover/Comunik/Controllers/ContactsController.html#method_createCustomRecord", "name": "Syscover\\Comunik\\Controllers\\ContactsController::createCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\ContactsController", "fromLink": "Syscover/Comunik/Controllers/ContactsController.html", "link": "Syscover/Comunik/Controllers/ContactsController.html#method_storeCustomRecord", "name": "Syscover\\Comunik\\Controllers\\ContactsController::storeCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\ContactsController", "fromLink": "Syscover/Comunik/Controllers/ContactsController.html", "link": "Syscover/Comunik/Controllers/ContactsController.html#method_editCustomRecord", "name": "Syscover\\Comunik\\Controllers\\ContactsController::editCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\ContactsController", "fromLink": "Syscover/Comunik/Controllers/ContactsController.html", "link": "Syscover/Comunik/Controllers/ContactsController.html#method_checkSpecialRulesToUpdate", "name": "Syscover\\Comunik\\Controllers\\ContactsController::checkSpecialRulesToUpdate", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\ContactsController", "fromLink": "Syscover/Comunik/Controllers/ContactsController.html", "link": "Syscover/Comunik/Controllers/ContactsController.html#method_updateCustomRecord", "name": "Syscover\\Comunik\\Controllers\\ContactsController::updateCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\ContactsController", "fromLink": "Syscover/Comunik/Controllers/ContactsController.html", "link": "Syscover/Comunik/Controllers/ContactsController.html#method_getEmailToUnsubscribe", "name": "Syscover\\Comunik\\Controllers\\ContactsController::getEmailToUnsubscribe", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\ContactsController", "fromLink": "Syscover/Comunik/Controllers/ContactsController.html", "link": "Syscover/Comunik/Controllers/ContactsController.html#method_unsubscribeEmail", "name": "Syscover\\Comunik\\Controllers\\ContactsController::unsubscribeEmail", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\ContactsController", "fromLink": "Syscover/Comunik/Controllers/ContactsController.html", "link": "Syscover/Comunik/Controllers/ContactsController.html#method_importRecordsPreview", "name": "Syscover\\Comunik\\Controllers\\ContactsController::importRecordsPreview", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\ContactsController", "fromLink": "Syscover/Comunik/Controllers/ContactsController.html", "link": "Syscover/Comunik/Controllers/ContactsController.html#method_importRecords", "name": "Syscover\\Comunik\\Controllers\\ContactsController::importRecords", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Comunik\\Controllers", "fromLink": "Syscover/Comunik/Controllers.html", "link": "Syscover/Comunik/Controllers/EmailCampaignsController.html", "name": "Syscover\\Comunik\\Controllers\\EmailCampaignsController", "doc": "&quot;Class EmailCampaignsController&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\EmailCampaignsController", "fromLink": "Syscover/Comunik/Controllers/EmailCampaignsController.html", "link": "Syscover/Comunik/Controllers/EmailCampaignsController.html#method_jsonCustomDataBeforeActions", "name": "Syscover\\Comunik\\Controllers\\EmailCampaignsController::jsonCustomDataBeforeActions", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\EmailCampaignsController", "fromLink": "Syscover/Comunik/Controllers/EmailCampaignsController.html", "link": "Syscover/Comunik/Controllers/EmailCampaignsController.html#method_createCustomRecord", "name": "Syscover\\Comunik\\Controllers\\EmailCampaignsController::createCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\EmailCampaignsController", "fromLink": "Syscover/Comunik/Controllers/EmailCampaignsController.html", "link": "Syscover/Comunik/Controllers/EmailCampaignsController.html#method_storeCustomRecord", "name": "Syscover\\Comunik\\Controllers\\EmailCampaignsController::storeCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\EmailCampaignsController", "fromLink": "Syscover/Comunik/Controllers/EmailCampaignsController.html", "link": "Syscover/Comunik/Controllers/EmailCampaignsController.html#method_editCustomRecord", "name": "Syscover\\Comunik\\Controllers\\EmailCampaignsController::editCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\EmailCampaignsController", "fromLink": "Syscover/Comunik/Controllers/EmailCampaignsController.html", "link": "Syscover/Comunik/Controllers/EmailCampaignsController.html#method_updateCustomRecord", "name": "Syscover\\Comunik\\Controllers\\EmailCampaignsController::updateCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\EmailCampaignsController", "fromLink": "Syscover/Comunik/Controllers/EmailCampaignsController.html", "link": "Syscover/Comunik/Controllers/EmailCampaignsController.html#method_showCampaign", "name": "Syscover\\Comunik\\Controllers\\EmailCampaignsController::showCampaign", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\EmailCampaignsController", "fromLink": "Syscover/Comunik/Controllers/EmailCampaignsController.html", "link": "Syscover/Comunik/Controllers/EmailCampaignsController.html#method_recordStatistic", "name": "Syscover\\Comunik\\Controllers\\EmailCampaignsController::recordStatistic", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\EmailCampaignsController", "fromLink": "Syscover/Comunik/Controllers/EmailCampaignsController.html", "link": "Syscover/Comunik/Controllers/EmailCampaignsController.html#method_sendTest", "name": "Syscover\\Comunik\\Controllers\\EmailCampaignsController::sendTest", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Comunik\\Controllers", "fromLink": "Syscover/Comunik/Controllers.html", "link": "Syscover/Comunik/Controllers/EmailPreferenceController.html", "name": "Syscover\\Comunik\\Controllers\\EmailPreferenceController", "doc": "&quot;Class EmailPreferenceController&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\EmailPreferenceController", "fromLink": "Syscover/Comunik/Controllers/EmailPreferenceController.html", "link": "Syscover/Comunik/Controllers/EmailPreferenceController.html#method_indexCustom", "name": "Syscover\\Comunik\\Controllers\\EmailPreferenceController::indexCustom", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\EmailPreferenceController", "fromLink": "Syscover/Comunik/Controllers/EmailPreferenceController.html", "link": "Syscover/Comunik/Controllers/EmailPreferenceController.html#method_updateCustomRecord", "name": "Syscover\\Comunik\\Controllers\\EmailPreferenceController::updateCustomRecord", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Comunik\\Controllers", "fromLink": "Syscover/Comunik/Controllers.html", "link": "Syscover/Comunik/Controllers/EmailTemplatesController.html", "name": "Syscover\\Comunik\\Controllers\\EmailTemplatesController", "doc": "&quot;Class EmailTemplatesController&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\EmailTemplatesController", "fromLink": "Syscover/Comunik/Controllers/EmailTemplatesController.html", "link": "Syscover/Comunik/Controllers/EmailTemplatesController.html#method_createCustomRecord", "name": "Syscover\\Comunik\\Controllers\\EmailTemplatesController::createCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\EmailTemplatesController", "fromLink": "Syscover/Comunik/Controllers/EmailTemplatesController.html", "link": "Syscover/Comunik/Controllers/EmailTemplatesController.html#method_storeCustomRecord", "name": "Syscover\\Comunik\\Controllers\\EmailTemplatesController::storeCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\EmailTemplatesController", "fromLink": "Syscover/Comunik/Controllers/EmailTemplatesController.html", "link": "Syscover/Comunik/Controllers/EmailTemplatesController.html#method_editCustomRecord", "name": "Syscover\\Comunik\\Controllers\\EmailTemplatesController::editCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\EmailTemplatesController", "fromLink": "Syscover/Comunik/Controllers/EmailTemplatesController.html", "link": "Syscover/Comunik/Controllers/EmailTemplatesController.html#method_updateCustomRecord", "name": "Syscover\\Comunik\\Controllers\\EmailTemplatesController::updateCustomRecord", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Comunik\\Controllers", "fromLink": "Syscover/Comunik/Controllers.html", "link": "Syscover/Comunik/Controllers/GroupsController.html", "name": "Syscover\\Comunik\\Controllers\\GroupsController", "doc": "&quot;Class GroupsController&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\GroupsController", "fromLink": "Syscover/Comunik/Controllers/GroupsController.html", "link": "Syscover/Comunik/Controllers/GroupsController.html#method_storeCustomRecord", "name": "Syscover\\Comunik\\Controllers\\GroupsController::storeCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Controllers\\GroupsController", "fromLink": "Syscover/Comunik/Controllers/GroupsController.html", "link": "Syscover/Comunik/Controllers/GroupsController.html#method_updateCustomRecord", "name": "Syscover\\Comunik\\Controllers\\GroupsController::updateCustomRecord", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Comunik\\Libraries", "fromLink": "Syscover/Comunik/Libraries.html", "link": "Syscover/Comunik/Libraries/Cron.html", "name": "Syscover\\Comunik\\Libraries\\Cron", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Comunik\\Libraries\\Cron", "fromLink": "Syscover/Comunik/Libraries/Cron.html", "link": "Syscover/Comunik/Libraries/Cron.html#method_checkCampaignsToCreate", "name": "Syscover\\Comunik\\Libraries\\Cron::checkCampaignsToCreate", "doc": "&quot;Funci\u00f3n que recupera las llamadas a realizar que ser\u00e1n enviadas a nuestra cola de procesos, tanto de emails de campa\u00f1as persistentes que no se hayan enviado,\n como correos de campa\u00f1as con fecha de envio anterior a la actual y que no se haya enviado.&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Libraries\\Cron", "fromLink": "Syscover/Comunik/Libraries/Cron.html", "link": "Syscover/Comunik/Libraries/Cron.html#method_checkSendEmails", "name": "Syscover\\Comunik\\Libraries\\Cron::checkSendEmails", "doc": "&quot;Function to check if there is to send any email&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Libraries\\Cron", "fromLink": "Syscover/Comunik/Libraries/Cron.html", "link": "Syscover/Comunik/Libraries/Cron.html#method_sendEmailsTest", "name": "Syscover\\Comunik\\Libraries\\Cron::sendEmailsTest", "doc": "&quot;Function which directly sends a test campaign group&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Libraries\\Cron", "fromLink": "Syscover/Comunik/Libraries/Cron.html", "link": "Syscover/Comunik/Libraries/Cron.html#method_checkBouncedEmailsAccountsToQueue", "name": "Syscover\\Comunik\\Libraries\\Cron::checkBouncedEmailsAccountsToQueue", "doc": "&quot;Funci\u00f3n que comprueba los rebotes de los emails en cada cuenta y ejecuta una acci\u00f3n seg\u00fan la coincidencia del patron encontrado&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Libraries\\Cron", "fromLink": "Syscover/Comunik/Libraries/Cron.html", "link": "Syscover/Comunik/Libraries/Cron.html#method_checkBouncedMessagesToQueue", "name": "Syscover\\Comunik\\Libraries\\Cron::checkBouncedMessagesToQueue", "doc": "&quot;Funci\u00f3n que recupera los contactos de una campa\u00f1a que tiene que enviar la newsletter y no esten en cola de envio&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Comunik\\Libraries", "fromLink": "Syscover/Comunik/Libraries.html", "link": "Syscover/Comunik/Libraries/Miscellaneous.html", "name": "Syscover\\Comunik\\Libraries\\Miscellaneous", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Comunik\\Libraries\\Miscellaneous", "fromLink": "Syscover/Comunik/Libraries/Miscellaneous.html", "link": "Syscover/Comunik/Libraries/Miscellaneous.html#method_setMailingLinks", "name": "Syscover\\Comunik\\Libraries\\Miscellaneous::setMailingLinks", "doc": "&quot;Function to get default email header&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Libraries\\Miscellaneous", "fromLink": "Syscover/Comunik/Libraries/Miscellaneous.html", "link": "Syscover/Comunik/Libraries/Miscellaneous.html#method_getEmlHeaders", "name": "Syscover\\Comunik\\Libraries\\Miscellaneous::getEmlHeaders", "doc": "&quot;Function to get default email header&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Libraries\\Miscellaneous", "fromLink": "Syscover/Comunik/Libraries/Miscellaneous.html", "link": "Syscover/Comunik/Libraries/Miscellaneous.html#method_getHeader", "name": "Syscover\\Comunik\\Libraries\\Miscellaneous::getHeader", "doc": "&quot;Function to get default html email header&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Libraries\\Miscellaneous", "fromLink": "Syscover/Comunik/Libraries/Miscellaneous.html", "link": "Syscover/Comunik/Libraries/Miscellaneous.html#method_getFooter", "name": "Syscover\\Comunik\\Libraries\\Miscellaneous::getFooter", "doc": "&quot;Function to get default html email footer&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Libraries\\Miscellaneous", "fromLink": "Syscover/Comunik/Libraries/Miscellaneous.html", "link": "Syscover/Comunik/Libraries/Miscellaneous.html#method_getThemes", "name": "Syscover\\Comunik\\Libraries\\Miscellaneous::getThemes", "doc": "&quot;Function to get themes to content builder&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Libraries\\Miscellaneous", "fromLink": "Syscover/Comunik/Libraries/Miscellaneous.html", "link": "Syscover/Comunik/Libraries/Miscellaneous.html#method_setHtmlLink", "name": "Syscover\\Comunik\\Libraries\\Miscellaneous::setHtmlLink", "doc": "&quot;Function to insert link to show online&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Libraries\\Miscellaneous", "fromLink": "Syscover/Comunik/Libraries/Miscellaneous.html", "link": "Syscover/Comunik/Libraries/Miscellaneous.html#method_setUnsubscribe", "name": "Syscover\\Comunik\\Libraries\\Miscellaneous::setUnsubscribe", "doc": "&quot;Function to insert link to unsubscribe&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Libraries\\Miscellaneous", "fromLink": "Syscover/Comunik/Libraries/Miscellaneous.html", "link": "Syscover/Comunik/Libraries/Miscellaneous.html#method_setTrackingPixel", "name": "Syscover\\Comunik\\Libraries\\Miscellaneous::setTrackingPixel", "doc": "&quot;Function to insert tracking pixel&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Libraries\\Miscellaneous", "fromLink": "Syscover/Comunik/Libraries/Miscellaneous.html", "link": "Syscover/Comunik/Libraries/Miscellaneous.html#method_htmlToText", "name": "Syscover\\Comunik\\Libraries\\Miscellaneous::htmlToText", "doc": "&quot;Function to convert html to text&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Libraries\\Miscellaneous", "fromLink": "Syscover/Comunik/Libraries/Miscellaneous.html", "link": "Syscover/Comunik/Libraries/Miscellaneous.html#method_checkEmailPattern", "name": "Syscover\\Comunik\\Libraries\\Miscellaneous::checkEmailPattern", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Comunik\\Models", "fromLink": "Syscover/Comunik/Models.html", "link": "Syscover/Comunik/Models/Contact.html", "name": "Syscover\\Comunik\\Models\\Contact", "doc": "&quot;Class Contact&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\Contact", "fromLink": "Syscover/Comunik/Models/Contact.html", "link": "Syscover/Comunik/Models/Contact.html#method_validate", "name": "Syscover\\Comunik\\Models\\Contact::validate", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\Contact", "fromLink": "Syscover/Comunik/Models/Contact.html", "link": "Syscover/Comunik/Models/Contact.html#method_scopeBuilder", "name": "Syscover\\Comunik\\Models\\Contact::scopeBuilder", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\Contact", "fromLink": "Syscover/Comunik/Models/Contact.html", "link": "Syscover/Comunik/Models/Contact.html#method_getGroups", "name": "Syscover\\Comunik\\Models\\Contact::getGroups", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\Contact", "fromLink": "Syscover/Comunik/Models/Contact.html", "link": "Syscover/Comunik/Models/Contact.html#method_addToGetRecordsLimit", "name": "Syscover\\Comunik\\Models\\Contact::addToGetRecordsLimit", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\Contact", "fromLink": "Syscover/Comunik/Models/Contact.html", "link": "Syscover/Comunik/Models/Contact.html#method_getCustomReturnRecordsLimit", "name": "Syscover\\Comunik\\Models\\Contact::getCustomReturnRecordsLimit", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\Contact", "fromLink": "Syscover/Comunik/Models/Contact.html", "link": "Syscover/Comunik/Models/Contact.html#method_getRecords", "name": "Syscover\\Comunik\\Models\\Contact::getRecords", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\Contact", "fromLink": "Syscover/Comunik/Models/Contact.html", "link": "Syscover/Comunik/Models/Contact.html#method_getCountriesContacts", "name": "Syscover\\Comunik\\Models\\Contact::getCountriesContacts", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\Contact", "fromLink": "Syscover/Comunik/Models/Contact.html", "link": "Syscover/Comunik/Models/Contact.html#method_getContactsEmailToInsert", "name": "Syscover\\Comunik\\Models\\Contact::getContactsEmailToInsert", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Comunik\\Models", "fromLink": "Syscover/Comunik/Models.html", "link": "Syscover/Comunik/Models/EmailCampaign.html", "name": "Syscover\\Comunik\\Models\\EmailCampaign", "doc": "&quot;Class EmailCampaign&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\EmailCampaign", "fromLink": "Syscover/Comunik/Models/EmailCampaign.html", "link": "Syscover/Comunik/Models/EmailCampaign.html#method_validate", "name": "Syscover\\Comunik\\Models\\EmailCampaign::validate", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\EmailCampaign", "fromLink": "Syscover/Comunik/Models/EmailCampaign.html", "link": "Syscover/Comunik/Models/EmailCampaign.html#method_scopeBuilder", "name": "Syscover\\Comunik\\Models\\EmailCampaign::scopeBuilder", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\EmailCampaign", "fromLink": "Syscover/Comunik/Models/EmailCampaign.html", "link": "Syscover/Comunik/Models/EmailCampaign.html#method_getCountries", "name": "Syscover\\Comunik\\Models\\EmailCampaign::getCountries", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\EmailCampaign", "fromLink": "Syscover/Comunik/Models/EmailCampaign.html", "link": "Syscover/Comunik/Models/EmailCampaign.html#method_getGroups", "name": "Syscover\\Comunik\\Models\\EmailCampaign::getGroups", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\EmailCampaign", "fromLink": "Syscover/Comunik/Models/EmailCampaign.html", "link": "Syscover/Comunik/Models/EmailCampaign.html#method_addToGetRecordsLimit", "name": "Syscover\\Comunik\\Models\\EmailCampaign::addToGetRecordsLimit", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\EmailCampaign", "fromLink": "Syscover/Comunik/Models/EmailCampaign.html", "link": "Syscover/Comunik/Models/EmailCampaign.html#method_getRecords", "name": "Syscover\\Comunik\\Models\\EmailCampaign::getRecords", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\EmailCampaign", "fromLink": "Syscover/Comunik/Models/EmailCampaign.html", "link": "Syscover/Comunik/Models/EmailCampaign.html#method_getCampaignsWithPersistence", "name": "Syscover\\Comunik\\Models\\EmailCampaign::getCampaignsWithPersistence", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\EmailCampaign", "fromLink": "Syscover/Comunik/Models/EmailCampaign.html", "link": "Syscover/Comunik/Models/EmailCampaign.html#method_getCampaignsNotCreated", "name": "Syscover\\Comunik\\Models\\EmailCampaign::getCampaignsNotCreated", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Comunik\\Models", "fromLink": "Syscover/Comunik/Models.html", "link": "Syscover/Comunik/Models/EmailSendHistorical.html", "name": "Syscover\\Comunik\\Models\\EmailSendHistorical", "doc": "&quot;Class EmailSendHistorical&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\EmailSendHistorical", "fromLink": "Syscover/Comunik/Models/EmailSendHistorical.html", "link": "Syscover/Comunik/Models/EmailSendHistorical.html#method_validate", "name": "Syscover\\Comunik\\Models\\EmailSendHistorical::validate", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\EmailSendHistorical", "fromLink": "Syscover/Comunik/Models/EmailSendHistorical.html", "link": "Syscover/Comunik/Models/EmailSendHistorical.html#method_scopeBuilder", "name": "Syscover\\Comunik\\Models\\EmailSendHistorical::scopeBuilder", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\EmailSendHistorical", "fromLink": "Syscover/Comunik/Models/EmailSendHistorical.html", "link": "Syscover/Comunik/Models/EmailSendHistorical.html#method_getRecords", "name": "Syscover\\Comunik\\Models\\EmailSendHistorical::getRecords", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Comunik\\Models", "fromLink": "Syscover/Comunik/Models.html", "link": "Syscover/Comunik/Models/EmailSendQueue.html", "name": "Syscover\\Comunik\\Models\\EmailSendQueue", "doc": "&quot;Class EmailSendHistorical&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\EmailSendQueue", "fromLink": "Syscover/Comunik/Models/EmailSendQueue.html", "link": "Syscover/Comunik/Models/EmailSendQueue.html#method_validate", "name": "Syscover\\Comunik\\Models\\EmailSendQueue::validate", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\EmailSendQueue", "fromLink": "Syscover/Comunik/Models/EmailSendQueue.html", "link": "Syscover/Comunik/Models/EmailSendQueue.html#method_scopeBuilder", "name": "Syscover\\Comunik\\Models\\EmailSendQueue::scopeBuilder", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\EmailSendQueue", "fromLink": "Syscover/Comunik/Models/EmailSendQueue.html", "link": "Syscover/Comunik/Models/EmailSendQueue.html#method_getNMailings", "name": "Syscover\\Comunik\\Models\\EmailSendQueue::getNMailings", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\EmailSendQueue", "fromLink": "Syscover/Comunik/Models/EmailSendQueue.html", "link": "Syscover/Comunik/Models/EmailSendQueue.html#method_getMailings", "name": "Syscover\\Comunik\\Models\\EmailSendQueue::getMailings", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\EmailSendQueue", "fromLink": "Syscover/Comunik/Models/EmailSendQueue.html", "link": "Syscover/Comunik/Models/EmailSendQueue.html#method_deleteMailingWithoutGroupSendQueue", "name": "Syscover\\Comunik\\Models\\EmailSendQueue::deleteMailingWithoutGroupSendQueue", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Comunik\\Models", "fromLink": "Syscover/Comunik/Models.html", "link": "Syscover/Comunik/Models/EmailTemplate.html", "name": "Syscover\\Comunik\\Models\\EmailTemplate", "doc": "&quot;Class EmailTemplate&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\EmailTemplate", "fromLink": "Syscover/Comunik/Models/EmailTemplate.html", "link": "Syscover/Comunik/Models/EmailTemplate.html#method_validate", "name": "Syscover\\Comunik\\Models\\EmailTemplate::validate", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Comunik\\Models", "fromLink": "Syscover/Comunik/Models.html", "link": "Syscover/Comunik/Models/Group.html", "name": "Syscover\\Comunik\\Models\\Group", "doc": "&quot;Class Group&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Comunik\\Models\\Group", "fromLink": "Syscover/Comunik/Models/Group.html", "link": "Syscover/Comunik/Models/Group.html#method_validate", "name": "Syscover\\Comunik\\Models\\Group::validate", "doc": "&quot;\n&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


