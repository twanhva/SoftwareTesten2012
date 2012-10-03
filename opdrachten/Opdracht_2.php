<?php
if (!empty($_POST['unsafe-submit'])) {
    // Trim away whitespace
    $username = trim($_POST['username']);
    // If no input, then set username to Anonymous
    $username = empty($username) ? "Anonymous" : $username;
    
    // Shorten message input to a maximum of 500 characters
    $message = substr($_POST['message'], 0, 500);
    
    // Execute query to insert the data into the database
    $query = "INSERT INTO `guestbook`(`username`, `message`) VALUES (:username, :message)";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam('username', $username);
    $stmt->bindParam('message', $message);
    $stmt->execute();
}

$query = "SELECT * FROM (Select * FROM guestbook ORDER BY time DESC LIMIT 5) AS t";
$qResult = mysql_query($query);
?>

<div id="header">
    <div id="logo">
        <h1><a href="#">Opdrachten</a></h1>
    </div>
</div>
<div id="page">
    <div id="content">
        <div class="box">
            <h2>Opdracht 2</h2>
            
            <p>
                Voor de tweede, en tevens laatste, opdracht is het de bedoeling dat de sin Web Server-Related Vulnerabilities wordt uitgelegd door middel van een demonstratie. Deze sin bestaat uit meerdere kwetsbaarheden, namelijk Cross-site Scripting(XSS), HTTP Response Splitting en Cross-site Request Forgery(XSRF). In deze opdracht hoeft er slechts een van de drie te worden gedemonstreerd. De keuze is voor ons gevallen op XSS.
            </p>
            
            <h3>Wat_is_XSS?</h3>
            
            <p>
                XSS is een kwetsbaarheid die kan worden uitgebuit zowel aan de server kant als de client kant. De gevolgen van XSS kunnen heel extreem zijn, zo kunnen cookies gestolen worden, de webpagina van nietsvermoedende bezoekers aangepast of vervangen worden en kan er potentieel allerlei andere (belangrijke) informatie doorgesluist worden naar de aanvaller.
            </p>
            
            <p>
                Er zijn drie types van XSS, in de volgende drie paragrafen worden de verschillende types behandeld met daarbij maatregelen die moeten worden getroffen om het type XSS te voorkomen.
            </p>
            
            <h4>DOM-Based_XSS</h4>
            
            <p>
                Met dit type XSS, ook wel Local XSS genoemd (type 0), kan bijvoorbeeld een session cookie gestolen worden. Hiermee kan een aanvaller zonder in het bezit te zijn van een gebruikersnaam en wachtwoord het account overnemen van een nietsvermoedende bezoeker. 
De aanvaller doet dit door een argument in de URL van een kwetsbare website te vervangen door een JavaScript fragment, zoals hieronder is afgebeeld.
            </p>
            
            <p>
                <script src="https://gist.github.com/3829164.js?file=DOM-Based XSS"></script>
            </p>
            
            <p>
                Als de website op enig moment de parameter default opvraagt en op de pagina weergeeft zonder de juiste beveiliging, dan wordt er een alert getoont met de inhoud van de session cookie. In dit fragment wordt een alert getoond, maar deze kwetsbaarheid kan op allerlei andere manier uitgebuit worden.
            </p>   

            <p>
                Tegenwoordig worden script tags door de browser ge-encode naar HTML en worden DOM-based XSS aanvallen daarmee afgeweerd. Hieronder staat een link die naar een DOM-Based XSS aanval leidt.
            </p>
            
            <p>
                <a href="index.php?page=domXSS.php&message=&lt;script>alert('Got You!');</script>">Deze link is onveilig!</a>
            </p>

            <p>
                Om niet afhankelijk te zijn van moderne browser is het zaak om zelf een beveiligingsmechanisme in te bouwen. Aangeraden worden om client-side encoding te gebruiken, maar dat is ook niet in alle omgevingen veilig. Een goede oplossing is om, indien er een malafide URL wordt gedetecteerd door bevoorbeeld een reguliere expressie op de input los te laten, de aanvraag compleet te weigeren. Hieronder staat een link waarbij de input wordt gecontroleerd door een regulier expressie die tevens in de code snippet te zien is.
            </p>
            
            <p>
                <a href="index.php?page=domXSSFixed.php&message=<script>alert('Got You!');</script>">Deze link is veilig!</a>
            </p>
            
            <p>
                <script src="https://gist.github.com/3829962.js?file=DOM-Based XSS Prevention"></script>
            </p>
            
            <h4><a id="reflected">Reflected_XSS</a></h4>
            
            <p>
                Dit type XSS, ook wel Non Persistent XSS genoemd (type 1), is de meest voorkomende van de
drie. Een klassiek voorbeeld van deze manier van XSS is een zoekmachine die zijn invoer
rechtstreeks weergeeft op de resultatenpagina zonder enige vorm van beveiliging. Het heet
Reflected XSS omdat deze manier van aanvallen meteen zichtbaar/merkbaar is voor de
gebruiker.
            </p>
            
            <div style="width: 40%; float:left;">
                <form action="#reflected" method="post">
                <input name="type" type="hidden" value="ALLOW_INJECTION"/>
                <div style="background-color: #4f798e; border: 1px solid aquamarine; width: 100%">
                    <h4 style="color:white; padding-left: 10px;">Search engine</h4>
                    <p style="color:white; padding-left: 10px;">
                        <input style="width: 150px" type="text" name="search-query" value="<?php echo isset($_POST['search-query']) ? htmlentities($_POST['search-query']) : '' ?>"/>
                        <input name="search-unsafe" type="submit" value="Search unsafe"/>
                        <input name="search-safe" type="submit" value="Search safe"/>
                    </p>
                </div>
                </form>
                <div style="background-color: #333; border: 1px solid aquamarine; width: 100%; color: white;">
                    <p style="color:white; padding-left: 10px;"><?php if(isset($_POST['search-query'])): ?>
            Searching for '<?php 
            if(isset($_POST['search-safe'])) {
                echo htmlentities($_POST['search-query']);
            } else {
                echo $_POST['search-query'];
            }
            ?>'...
            <?php else : ?>
            Enter search expression
            <?php endif; ?>
                    </p>
                </div>
            </div>
            
            
            <div style="clear: both"></div>
            <br/>
            <br/>

            <p>
                Om dit type XSS op te voorkomen is het belangrijk dat alle output ge-encode wordt naar HTML. Uiteraard zou een stukje input validatie ook niet mistaan. In PHP wordt het encoden gedaan met het volgende code fragment.
            </p>
            
            <p>
                <script src="https://gist.github.com/f2d922c78ccc7cd58fd2.js?file=Reflected XSS Prevention"></script>
            </p>
            
            
            <p>
                De methode htmlentities zorgt ervoor dat de JavaScript code die eventueel geinjecteerd is, wordt omgezet naar ge-encode HTML characters die veilig weergegeven kunnen worden.
            </p>
            
            <h4>Stored_XSS</h4>
            <p>
                Dit type XSS, ook wel Persistent XSS genoemd (type 2), heeft een veel grotere impact dan de andere manieren van XSS. Bij type 2 van XSS wordt namelijk de gevaarlijke code van de aanvaller opgeslagen op de server. De code heeft dus meestal een blijvend effect en kan dus schade blijven aanrichten.<br/> 
Een voorbeeld van dit type XSS is op deze pagina uitgewerkt. Op deze pagina staat namelijk een gastenboek waarin de bezoeker een bericht kan achterlaten dat vervolgens getoond wordt bij de berichten van vorige bezoekers. Bij onvoldoende beveiliging kan een aanvaller malafide code meesturen in het bericht. Elke bezoeker die vervolgens deze pagina bezoekt zal te maken krijgen met XSS. Nu is het in dit geval een demonstratiepagina, maar dit kan, indien niet juist beveiligd, ook plaatsvinden op een website als YouTube die miljoenen bezoekers op een dag krijgt.
            </p>
            
            <p>
                Om dit type XSS te voorkomen is het belangrijk dat alle output, dus in dit geval het laten zien van de comments, ge-encode wordt naar HTML. In PHP wordt dit gedaan met het volgende code fragment. Uiteraard zou het normaal een goed idee zijn om de velden bij het posten ook te valideren, maar voor de voorbeeld doeleinden hebben we dat niet gedaan.
            </p>
            
            <p>
                <script src="https://gist.github.com/3829326.js?file=Stored XSS Prevention"></script>
            </p>
            
            <p>
                Ook hier zorgt de htmlentities methode ervoor dat de JavaScript code die geinjecteerd is, wordt omgezet naar ge-encode HTML characters. Hierdoor wordt de JavaScript code zichtbaar voor de bezoeker en wordt het niet uitgevoerd als JavaScript zijnde.
            </p>

            <hr/><br/>
            <h4><a id="stored">Stored XSS: Gastenboek Demonstratie</a></h4>
            <form action="index.php?page=opdrachten/Opdracht_2.php#stored" method="post">
            <input type="submit" name="reload-safe" value="Reload safe"/>
            <input type="submit" name="reload-unsafe" value="Reload unsafe"/>
            </form><br/>
            
            <div style="float: left; width: 450px;">
                <?php
                if (isset($qResult)) {
                    while ($res = mysql_fetch_array($qResult, MYSQL_ASSOC)) {
                        // If the 'safe' form has been used to submit a message and the checkbox is unchecked, then protect
                        // against Cross Site Scripting by using htmlentities.
                       // $useSafe = (!empty($_POST['safe-submit2']) && !isset($_POST['showCSS']));
                        $useSafe = !isset($_POST['reload-unsafe']);
                        $message = $useSafe ? htmlentities($res['message']) : $res['message'];
                        $username = $useSafe ? htmlentities($res['username']) : $res['username'];
                        $id = $useSafe ? htmlentities($res['id']) : $res['id'];
                        $time = $useSafe ? htmlentities($res['time']) : $res['time'];
                        
                            ?>
                            <div style="margin-bottom: 10px; width: 400px; min-height: 70px; border: 2px solid #333">
                                <div style="width: 100%; min-height: 50px; border-bottom: 2px dotted #333;">
                                    <p style="line-height: 16px; margin: 5px; word-wrap: break-word; font-style: italic; font-size: 12px"><?php echo $message ?></p>
                                </div>
                                <div style="height: 20px; width: 100%;">
                                    <p style="text-align: center; font-style: italic; font-size: 10px">By <?php echo $username."(".$id.")" ?> On <?php echo $time ?></p>
                                </div>
                            </div>
                <?php
                    }
                }
                ?>
            </div>
            <div style="float: right; width: 400px">
                <form method="post">
                    <input name="type" type="hidden" value="ALLOW_CSS"/>
                    <div style="padding: 2%; background-color: #4f798e; border: 1px solid aquamarine; width: 96%">
                        <h4 style="color:white;">Leave_a_message</h4>
                        <p style="color:white; width: 100%">
                            Name: <input style="height: 20px; width: 150px" type="text" name="username" value="" /><br/>
                            Message: <br/><textarea style="resize: none; width: 100%; min-height: 100px" name="message"></textarea>
                            <input style="margin-top: 10px" name="unsafe-submit" type="submit" value="Submit"/>
                        </p>
                    </div>
                </form>
            </div>

        </div>
        <hr/><br/>
        
    </div>
    <br class="clearfix" />
</div>
