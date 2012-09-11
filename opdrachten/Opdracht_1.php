<div id="header">
    <div id="logo">
        <h1><a href="#">Opdrachten</a></h1>
    </div>
</div>
<div id="page">
    <div id="content"><div class="box">
            <h2>Opdracht 1</h2>
            <p>
                Voor de eerste opdracht hebben wij ervoor gekozen om de sin 'SQL Injectie' als voorbeeld te gebruiken. SQL Injectie is een manier waarbij ongeautorizeerde mensen toegang kunnen krijgen tot een systeem. 
            </p>
            <p>
                SQL Injectie kan je voorkomen door je systeem optimaal te beveiligen. Als dit niet het geval is, kunnen kwaadwillenden heel gemakkelijk toegang krijgen tot de database van het desbetreffende systeem, met als gevolg dat al je data verloren kan gaan en/of op straat kan 'liggen'.
            </p>
            <h3>Maar hoe werkt het dan precies?</h3>
            <p>Om SQL Injectie goed te kunnen begrijpen gaan wij hieronder twee demonstraties uitvoeren met bijbehorende commentaar. De demonstratie zal bestaan uit twee simpele log in schermen. In de eerste log in scherm is het 'systeem' niet optimaal beveiligd waardoor een kwaadwillende d.m.v. SQL Injectie zichzelf toegang kan verschaffen tot de database. In de tweede demonstratie laten wij zien hoe dit optimaal beveiligd kan worden met bijbehorende commentaar.</p>
            <h3>Demo 1 (Geen beveiliging)</h3>
            <p>Bij de eerste demonstratie ziet u het log-in scherm van Huisartspraktijk HVA. Alle gegevens van patienten binnen de praktijk zijn vertrouwelijk en zijn daarom beschermd met een unieke gebruikersnaam en een wachtwoord.</p>
            <p>Als een kwaadwillende toegang wilt krijgen tot het systeem kan hij het volgende</p>
            <div style="width: 40%; float:left;">
                <div style="background-color: #4f798e; border: 1px solid aquamarine; width: 100%">
                    <h4 style="color:white; padding: 10px;">Huisartspraktijk HVA</h4>
                    <p style="color:white; padding: 10px;">
                        Username: <input type="text" value="Username" />
                    </p>
                    <p style="color:white; padding: 10px;">
                        Password: <input type="text" value="password" /><br/>
                        <br/>
                        <input type="submit" value="Log in"/>
                    </p>
                </div>
                <div style="background-color: #333; border: 1px solid aquamarine; width: 100%; color: white;">
                    <h4 style="color:white; padding: 10px;">Resultaat: </h4>
                    <p style="padding-left:10px;">De volgende query is zojuist uitgevoerd:<br/>
                    <i>***QUERY***</i><br/>
                Hieruit kwam het volgende resultaat:<br>
                <table style="color: white; width: 100%;">
                    <thead>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Password</th>
                </thead>
                <tbody style="text-align: center;">
                    <tr>
                        <td>??</td>
                        <td>??</td>
                        <td>??</td>
                    </tr>
                </tbody>
                </table>
                </p>
                </div>
            </div>
            <div style=" width:55%; float: right;">
                Momenteel zitten de volgende records in de database:<br/><br/>
                <table style="width: 100%;">
                    <thead>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Password</th>
                </thead>
                <tbody style="text-align: center;">
                    <tr>
                        <td>1</td>
                        <td>sinan</td>
                        <td>test</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>twan</td>
                        <td>test</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>patrick</td>
                        <td>test</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>kevin</td>
                        <td>test</td>
                    </tr>
                </tbody>
                </table>
                
            </div>
            <div style="clear:both;"></div>
            <br/>
            <h3>Demo 1 (Wel beveiliging)</h3>
            <p>Bij de eerste demonstratie ziet u het log-in scherm van Huisartspraktijk HVA. Alle gegevens van patienten binnen de praktijk zijn vertrouwelijk en zijn daarom beschermd met een unieke gebruikersnaam en een wachtwoord.</p>
            <p>Als een kwaadwillende toegang wilt krijgen tot het systeem kan hij het volgende</p>
            <div style="width: 40%; float:left;">
                <div style="background-color: #4f798e; border: 1px solid aquamarine; width: 100%">
                    <h4 style="color:white; padding: 10px;">Huisartspraktijk HVA</h4>
                    <p style="color:white; margin: 0px; padding: 0px;">
                        Username: <input type="text" value="Username" />
                    </p>
                    <p style="color:white; margin: 0px;padding: 10px;">
                        Password: <input type="password" value="password" /><br/>
                        <br/>
                        <input type="submit" value="Log in"/>
                    </p>
                </div>
                <div style="background-color: #333; border: 1px solid aquamarine; width: 100%;">
                    <h4 style="color:white; padding: 10px;">Resultaat: </h4>
                </div>
            </div>
            <div style=" width:55%; float: right;">
                <p>Nadat er op 'Log in' was gedrukt is de volgende query uitgevoerd:<br/><br/> <i>SELECT * FROM users WHERE username='Username' AND password='X' OR 1=1'</i><br/><br/> Omdat 1 gelijk is aan 1 krijgt diegene dus in deze situatie toegang tot het systeem. Het zou in sommige gevallen erger kunnen uitpakken waardoor al je data in de database zelfs verwijderd kan worden!</p>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
    <br class="clearfix" />
</div>
