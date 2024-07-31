<?php
/**
 * Template Name: News
 */
?>
<html>
    <head>News
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="../wp-content/themes/training/html/scripts/news.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <br><label>Header</label>&nbsp;&nbsp;:&nbsp;&nbsp;<input type="text" id="header" name="header">
        <br><br><label>Content</label>&nbsp;&nbsp;:&nbsp;&nbsp;<textarea id="content" name="content"></textarea>
        <br><br><button type="submit" name="sub-btn" id="sub-btn" >SUBMIT</button><br><br>
        <!-- &nbsp;&nbsp;<button type="submit" name="view-btn" id="view-btn" >View</button> -->
        
        <tabel class="newsprint">
            <tr>
                <th>id</th>
                <th>header</th>
                <th>content</th>
            </tr>
            <tr>
                <td id="nid" name="nid" value=""></id>
                <td id="nheader" name="nheader" value=""></id>
                <td id="ncontent" name="content" value=""></id>
            </tr>
        </tabel>
    </body>
</html>
