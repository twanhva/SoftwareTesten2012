<?php
if(isset($_POST['username'])) {
    if($_POST['type'] == 'ALLOW_INJECTION') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query1 = "SELECT * FROM users WHERE username = '" . $username . "' AND password = '" . $password . "'";
        $qResult1 = mysql_query($query1);
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query2 = "SELECT * FROM users WHERE username = :username AND password = :password";
        $stmt = $dbh->prepare($query2);
        $stmt->bindParam('username', $username);
        $stmt->bindParam('password', $password);
        $stmt->execute();
    }
    
}
?>
<div id="header">
    <div id="logo">
        <h1><a href="#">Opdrachten</a></h1>
    </div>
</div>
<div id="page">
    <div id="content"><div class="box">
            <h2>Opdracht 1</h2>
            <h3><a href="opdrachten/questionaire_1.pdf">Download hier de questionaire!</a></h3>
            <p>
                Voor de eerste opdracht hebben wij ervoor gekozen om de sin 'SQL Injectie' als voorbeeld te gebruiken. SQL Injectie is een aanvalsmethode waarbij ongeautorizeerde mensen toegang kunnen krijgen tot een systeem. 
            </p>
            <p>
                SQL Injectie kan voorkomen worden door het systeem optimaal te beveiligen. Als dit niet het geval is, kunnen kwaadwillenden vaak gemakkelijk toegang krijgen tot de database van het desbetreffende systeem, met als gevolg dat al de data verloren kan gaan en/of 'op straat kan komen te liggen'.
            </p>
            <h3>Maar hoe werkt het dan precies?</h3>
            <p>Om SQL Injectie goed te kunnen begrijpen worden hieronder twee demonstraties gegeven met bijbehorend commentaar. De demonstraties bestaan uit twee simpele login schermen. In het eerste login scherm is het systeem niet optimaal beveiligd waardoor een kwaadwillende d.m.v. SQL Injectie zichzelf toegang kan verschaffen tot de database. In de tweede demonstratie wordt getoond hoe het systeem optimaal beveiligd kan worden met daarbij een uitleg.</p>
            <h3>Systeem Opbouw</h3>
            <div>
                <p>Het betreft hier een patiëntenbeheersyteem van Huisartspraktijk HVA. Alle gegevens van de patiënten van de praktijk zijn vertrouwelijk en zijn daarom beschermd met een unieke gebruikersnaam en een wachtwoord.<p/>
                Momenteel zitten de volgende records in de database:<br/>
                <table style="width: 100%;">
                    <thead>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Password</th>
                </thead>
                <tbody style="text-align: center;">
                    <?php 
                        $f = mysql_query('SELECT * FROM users');
                        while ($res = mysql_fetch_array($f, MYSQL_ASSOC)) { ?>
                    <?php //var_dump($res); ?>
                             <tr>
                        <td><?php echo $res['id'] ?></td>
                        <td><?php echo $res['username'] ?></td>
                        <td><?php echo $res['password'] ?></td>
                    </tr>

                        <?php }
                    ?>
                    
                </tbody>
                </table> 
                <br/><br/>
            </div>
            <h3><a id="demo_niet_beveiligd">Demo 1 (Niet beveiligd)</a></h3>
            <p>Hieronder ziet u het login scherm van Huisartspraktijk HVA.</p>
            <p>Als een kwaadwillende toegang wil krijgen tot het systeem kan hij/zij het als volgt te werk gaan:</p>
            <div style="width: 40%; float:left;">
                <form action="#demo_niet_beveiligd" method="post">
                <input name="type" type="hidden" value="ALLOW_INJECTION"/>
                <div style="background-color: #4f798e; border: 1px solid aquamarine; width: 100%">
                    <h4 style="color:white; padding-left: 10px;">Huisartspraktijk HVA</h4>
                    <p style="color:white; padding-left: 10px;">
                        Username: <input type="text" name="username" value="<?php echo (isset($_POST['username']) ? $_POST['username'] : '') ?>" /><br/>
                        Password: <input type="text" name="password" value="<?php echo (isset($_POST['password']) ? $_POST['password'] : '') ?>" />
                        <input type="submit" value="Log in"/>
                    </p>
                </div>
                </form>
                <div style="background-color: #333; border: 1px solid aquamarine; width: 100%; color: white;">
                    <h4 style="color:white; padding-left: 10px;">Resultaat: </h4>
                    <p style="padding-left:10px;">De volgende query is zojuist uitgevoerd:<br/>
                    <i><?php echo (isset($query1) ? $query1 : '--') ?></i><br/>
                Hieruit kwam het volgende resultaat:<br>
                <table style="color: white; width: 100%;">
                    <thead>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Password</th>
                </thead>
                <tbody style="text-align: center;">
                    <?php 
                    if(isset($qResult1))  {
                        while ($res = mysql_fetch_array($qResult1, MYSQL_ASSOC)) { ?>
                    <?php //var_dump($res); ?>
                             <tr>
                        <td><?php echo $res['id'] ?></td>
                        <td><?php echo $res['username'] ?></td>
                        <td><?php echo $res['password'] ?></td>
                    </tr>

                        <?php }
                    } else { ?>
                        <tr>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <?php }
                    ?>
                </tbody>
                </table>
                </p>
                </div>
            </div>
            <div style=" width:55%; float: right; padding-right: 30px">
                <p>De query die wordt opgesteld is:
                    <span style="color: green">SELECT * FROM users WHERE username = '?' AND password = '?'</span>. Omdat de vraagtekens vervangen worden met de ingevoerde waardes komt er een mogelijk gevaarlijke query uit. Zo zou de gebruiker bijvoorbeeld kunnen inloggen door bij het username-veld <i>' OR 1=1#</i> in te vullen.
                    De query wordt dan:
                    <span style="color: green">SELECT * FROM users WHERE username = '' OR 1=1#' AND password = '?'</span> waarbij alles achter de # als commentaar wordt gezien. De resulterende query is dan:
                    <span style="color: green">SELECT * FROM users WHERE username = '' OR 1=1</span>. Omdat 1=1 altijd waar is zal iedere rij in de users-tabel matchen en dus worden teruggestuurd.
                    het systeem. De aanvaller heeft op dit systeem heel veel mogelijkheden, zo kan hij of zij zelfs al de data in de database verwijderen en/of publiceren!</p>
                    De relevante code is:
<pre>
$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * FROM users 
            WHERE username = '" . $username . "' 
            AND password = '" . $password . "'";
$qResult = mysql_query($query);
</pre>
            </div>
            
            <div style="clear:both;"></div>
            <br/>
            <h3><a id="demo_beveiligd">Demo 1 (Beveiligd)</a></h3>
            <p>Hieronder ziet u het login scherm van Huisartspraktijk HVA.</p>
            <p>Als een kwaadwillende toegang wil krijgen tot het systeem kan hij/zij het als volgt te werk gaan:</p>
            <div style="width: 40%; float:left;">
                <form action="#demo_beveiligd" method="post">
                <input name="type" type="hidden" value="NO_INJECTION"/>
                <div style="background-color: #4f798e; border: 1px solid aquamarine; width: 100%">
                    <h4 style="color:white; padding-left: 10px;">Huisartspraktijk HVA</h4>
                    <p style="color:white; padding-left: 10px;">
                        Username: <input type="text" name="username" value="<?php echo (isset($_POST['username']) ? $_POST['username'] : '') ?>" /><br/>
                        Password: <input type="text" name="password" value="<?php echo (isset($_POST['password']) ? $_POST['password'] : '') ?>" />
                        <input type="submit" value="Log in"/>
                    </p>
                </div>
                </form>
                <div style="background-color: #333; border: 1px solid aquamarine; width: 100%; color: white;">
                    <h4 style="color:white; padding-left: 10px;">Resultaat: </h4>
                    <p style="padding-left:10px;">De volgende query is zojuist uitgevoerd:<br/>
                    <i><?php echo (isset($query2) ? $query2 : '--') ?></i><br/>
                Hieruit kwam het volgende resultaat:<br>
                <table style="color: white; width: 100%;">
                    <thead>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Password</th>
                </thead>
                <tbody style="text-align: center;">
                    <?php 
                    if(isset($stmt))  {
                        while ($res = $stmt->fetch()) { ?>
                    <?php //var_dump($res); ?>
                             <tr>
                        <td><?php echo $res['id'] ?></td>
                        <td><?php echo $res['username'] ?></td>
                        <td><?php echo $res['password'] ?></td>
                    </tr>

                        <?php }
                    } else { ?>
                        <tr>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <?php }
                    ?>
                </tbody>
                </table>
                </p>
                </div>
            </div>
            <div style=" width:55%; float: right; padding-right: 30px">
                <p>Nadat er op 'Login' is gedrukt is de volgende query uitgevoerd:<br/><br/> <i>SELECT * FROM users WHERE username='Username' AND password='X' OR 1=1'</i><br/><br/> Omdat 1 gelijk is aan 1 krijgt de gebruiker in deze situatie toegang tot het systeem. De aanvaller heeft op dit systeem heel veel mogelijkheden, zo kan hij of zij zelfs al de data in de database verwijderen en/of publiceren!</p>
                De relevante code is:
<pre>
$username = $_POST['username'];
$password = $_POST['password'];
$query2 = "SELECT * FROM users 
            WHERE username = :username 
            AND password = :password";
$stmt = $dbh->prepare($query2);
$stmt->bindParam('username', $username);
$stmt->bindParam('password', $password);
$stmt->execute();
</pre>
            </div>
            
            <div style="clear:both;"></div>
        </div>
    </div>
    <br class="clearfix" />
</div>
