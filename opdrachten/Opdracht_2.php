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

if (!empty($_POST['safe-submit'])) {
    // Trim away whitespace
    $username = trim($_POST['username']);
    // Check for empty username and for usage of only alphabetical characters. If positive condition, 
    // then set username to Anonymous
    if(empty($username) || !preg_match("[a-zA-z]{2, 256}", $username)) {
        $username = "Anonymous";
    }
    
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

            <div style="float: left; width: 450px;">
                <?php
                if (isset($qResult)) {
                    while ($res = mysql_fetch_array($qResult, MYSQL_ASSOC)) {
                        // If the 'safe' form has been used to submit a message and the checkbox is unchecked, then protect
                        // against Cross Site Scripting by using htmlentities.
                        if (!empty($_POST['safe-submit']) && !isset($_POST['showCSS'])) {
                            ?>
                            <div style="margin-bottom: 10px; width: 400px; min-height: 70px; border: 2px solid #333">
                                <div style="width: 100%; min-height: 50px; border-bottom: 2px dotted #333;">
                                    <p style="line-height: 16px; margin: 5px; word-wrap: break-word; font-style: italic; font-size: 12px"><?php echo htmlentities($res['message']) ?></p>
                                </div>
                                <div style="height: 20px; width: 100%;">
                                    <p style="text-align: center; font-style: italic; font-size: 10px">By <?php echo htmlentities($res['username']."(".$res['id'].")") ?> On <?php echo htmlentities($res['time']) ?></p>
                                </div>
                            </div>

                            <?php
                        } else {
                            ?>
                            <div style="margin-bottom: 10px; width: 400px; min-height: 70px; border: 2px solid #333">
                                <div style="width: 100%; min-height: 50px; border-bottom: 2px dotted #333;">
                                    <p style="line-height: 16px; margin: 5px; word-wrap: break-word; font-style: italic; font-size: 12px"><?php echo $res['message'] ?></p>
                                </div>
                                <div style="height: 20px; width: 100%;">
                                    <p style="text-align: center; font-style: italic; font-size: 10px">By <?php echo $res['username']."(".$res['id'].")" ?> On <?php echo $res['time'] ?></p>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
            <div style="float: right; width: 400px">
                <form method="post">
                    <input name="type" type="hidden" value="ALLOW_CSS"/>
                    <div style="padding: 2%; background-color: #4f798e; border: 1px solid aquamarine; width: 96%">
                        <h4 style="color:white;">Leave_a_message_(Unsafe)</h4>
                        <p style="color:white; width: 100%">
                            Name: <input style="height: 20px; width: 150px" type="text" name="username" value="" /><br/>
                            Message: <br/><textarea style="resize: none; width: 100%; min-height: 100px" name="message"></textarea>
                            <input style="margin-top: 10px" name="unsafe-submit" type="submit" value="Submit"/>
                        </p>
                    </div>
                </form>

                <form style="margin-top: 10px" method="post">
                    <input name="type" type="hidden" value="ALLOW_CSS"/>
                    <div style="padding: 2%; background-color: #4f798e; border: 1px solid aquamarine; width: 96%">
                        <h4 style="color:white;">Leave_a_message_(Safe)</h4>
                        <p style="color:white; width: 100%">
                            Name: <input style="height: 20px; width: 150px" type="text" name="username" value="" /><br/>
                            Message: <br/><textarea style="resize: none; width: 100%; min-height: 100px" name="message"></textarea>
                            <input type="checkbox" name="showCSS" value="showCSS" /> Show potential Cross Site Scripting<br/>
                            <input style="margin-top: 10px" name="safe-submit" type="submit" value="Submit"/>
                        </p>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <br class="clearfix" />
</div>
