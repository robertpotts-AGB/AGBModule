<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 2019-03-31
 * Time: 14:10
 * V2.0
 */
require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once('Common/Fun_FormatText.inc.php');
include('Common/Templates/head.php');

if(array_key_exists('EvCode',$_POST)){
    setBookingInRef();
}
if(array_key_exists('OldCode',$_POST)){
    replace_in_file();
}


function setBookingInRef()
{
    if (isset($_POST['EvCode']) && trim($_POST['EvCode']) != "") {
        $fp = fopen("./Bookingin/Bkinconfig.php", 'w');
        fwrite($fp, '<?php');
        fwrite($fp, ' ');
        fwrite($fp, '$TourCode = "' . trim($_POST['EvCode']) . '";');
        fwrite($fp, ' ');
        fwrite($fp, '?>');
        fclose($fp);
    }
}
function replace_in_file()
{
    if (file_exists($_SERVER['DOCUMENT_ROOT']."/ianseo/Modules/Sets/UK/Functions/Common_MakeTeams.php"))
    echo "file exists";


    $full_path_to_file = $_SERVER['DOCUMENT_ROOT']."/ianseo/Modules/Sets/UK/Functions/Common_MakeTeams.php";
    $OldText = ($_POST['OldCode']);
    $NewText = ($_POST['NewCode']);
    echo $OldText;
    echo $NewText;
    echo $full_path_to_file;

    $contents = file_get_contents( $full_path_to_file );
    if( $contents === false )
    {
echo "could Not Read";   }
    $contents = str_replace( $OldText, $NewText, $contents );
    file_put_contents( $full_path_to_file, $contents );
    $bytes_written = file_put_contents( $full_path_to_file, $contents );
    if( $bytes_written !== strlen( $contents ) )

    {
echo "Could not write";   }
}

    ?>
<style type="text/css">

    table.outlined {
        border-collapse: collapse;
    }

    table.outlined tr {
        border: 2px solid black;
    }
    table.outlined td {
        text-align:right;
    }
</style>



<table class="outlined">

    <tr>
        <td >
            <h2>Ranking System Exports</h2>
        </td>

        <td>
            <form method="post">
                <input style="border-radius:8px;font-size:16px;background-color: Green;color: white; padding: 15px 32px;" type="button" value="1440 Results Export" onClick="window.open('./RankingExport/Dbl1440Exp.php','windowname',' width=400,height=200')" /><br/>
            </form>
        </td>
        <td>
            <form method="post">
                <input style="border-radius:8px;font-size:16px;background-color: Green;color: white; padding: 15px 32px;" type="button" value="720+H2H Results Export" onClick="window.open('./RankingExport/ExportTSV.php','windowname',' width=400,height=200')" /><br/>
            </form>
        </td>
    </tr>
        <tr>
        <td >
            <h2> Double Round Amalgamation - Use carefully</h2>
            <h3> Specify 'TourID' of the twin event and Click 'Amalgamate'</h3>
            <td align="center">
            <form method="get" action="DoubleResultAdd.php">
                <input style="font-size:16px" type="Text" name="Tour2">
               <td> <input style="border-radius:8px;font-size:16px;background-color: orangered;color: white; padding: 15px 32px;" type="submit" value="Amalgamate">
        </td>
        </form>
        </td>
        </td>
        </tr>
    <tr>
        <td >
            <h2>Club Setups</h2>
        </td>
        <td> <form method="post">
                <input style="border-radius:8px;font-size:16px;background-color: Green;color: white; padding: 15px 32px;" type="button" value="Import Archery GB Clubs" onClick="window.open('./Clubs/ClubImport.php','windowname',' width=400,height=200')" /><br/>
            </form>
        </td>
        <td>
            <form method="post">
                <input style="border-radius:8px;font-size:16px;background-color: Green;color: white; padding: 15px 32px;" type="button" value="Link Counties and Regions" onClick="window.open('./Clubs/ClubUpdate.php','windowname',' width=400,height=200')" /><br/>
            </form>
        </td>
        <td>
            <form method="post">
                <input style="border-radius:8px;font-size:16px;background-color: Grey;color: white; padding: 15px 32px;" type="button" value="Delete All Clubs" onClick="window.open('./Clubs/ClubDelete.php','windowname',' width=400,height=200')" /><br/>
            </form>
        </td>
    </tr>
   <tr>
       <td >
           <h2>Triple Event Points Exports</h2>
       </td>
       <td>
           <form method="post">
               <input style="border-radius:8px;font-size:16px;background-color: Green;color: white; padding: 15px 32px;" type="button" value="H2H Ranking Export" onClick="window.open('./Tripple/H-HRankingExport.php','windowname',' width=400,height=200')" /><br/>
           </form>
       </td>
       <td>
           <form method="post">
               <input style="border-radius:8px;font-size:16px;background-color: Green;color: white; padding: 15px 32px;" type="button" value="70m/50m Ranking Round Export" onClick="window.open('./Tripple/F7050Rank.php','windowname',' width=400,height=200')" /><br/>
           </form>
       </td>
       <td>
           <form method="post">
               <input style="border-radius:8px;font-size:16px;background-color: Green;color: white; padding: 15px 32px;" type="button" value="1440 Round Export" onClick="window.open('./Tripple/FITARankingExport.php','windowname',' width=400,height=200')" /><br/>
           </form>
       </td>
   </tr>

    <tr>
        <td >
            <h2> Event Specific Exports</h2>
        </td>

        <td>
            <form method="post">
                <input style="border-radius:8px;font-size:16px;background-color: Green;color: white; padding: 15px 32px;" type="button" value="UK Masters Distance Awards" onClick="window.open('./Tripple/QuResults.php','windowname',' width=400,height=200')" /><br/>
            </form>
        </td>
        <td>
            <form method="post">
                <input style="border-radius:8px;font-size:16px;background-color: Green;color: white; padding: 15px 32px;" type="button" value="BTC Distance Awards" onClick="window.open('./Tripple/BTCDist.php','windowname',' width=400,height=200')" /><br/>
            </form>
        </td>
    </tr>

    <tr>
        <td >
            <h2> Event Registration Module</h2>
            <h3> Specify 'TourID' of the event and Click 'Set Code'</h3>
        </td>

        <td align="center">
            <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                <input style="font-size:16px" type="Text" name="EvCode">
        <td> <input style="border-radius:8px;font-size:16px;background-color: orangered;color: white; padding: 15px 32px;" type="submit" value="Set Code">
        </td>
        </form>
        </td>
        </td>
        <td>
            <form method="post">
                <input style="border-radius:8px;font-size:16px;background-color: Green;color: white; padding: 15px 32px;" type="button" value="Open Registration System" onClick="window.open('./Bookingin/Bookingin.php','windowname',' width=400,height=200')" /><br/>
            </form>
        </td>
    </tr>

    <tr>
        <td>
            <h2> Team Customisation</h2>
            <h3> Specifiy the Old Team Creation code, the new team code and click 'Replace'</h3>
            <p>  Team creation code is, using numeric values, set the numbers for: (0,[Men],[Women],[Any])</p>
            <p> for exmple a team of four needing 1 from each gender would be: (0,1,1,2) (1 male, 1 female, 2 others, totalling 4)</p>
        </td>

        <td align="center">
            <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                <p>Old Code: <input style="font-size:16px" type="Text" name="OldCode"></p>
                <p>New Code: <input style="font-size:16px" type="Text" name="NewCode"></p>
        <td> <input style="border-radius:8px;font-size:16px;background-color: orangered;color: white; padding: 15px 32px;" type="submit" value="Replace">
        </td>
        </form>
        </td>
        </td>

    </tr>
       <tr>
        <td>
            <h2> WAP Configuration</h2>
        </td>
           
        <td>
            <p>ScoringYellow - 192.168.0.212</p>   
            <p>ScoringRed - 192.168.0.210</p>
            <p>ScoringBlack - 192.168.0.211</p>
        </td>
        <td> 
            <p>ScoringYellow - Target 1-32</p>
            <p>ScoringRed - Target 32-64</p>
            <p>ScoringBlack - Target 65-96</p>  
        </td>
        </td>

    </tr>
  <tr>
        <td>
            <h2> FlagFile Copy</h2>
        </td>
           
        <td>
          <form method="post" action="./Clubs/FlagImport.php">
              
               <td> <input style="border-radius:8px;font-size:16px;background-color: orangered;color: white; padding: 15px 32px;" type="submit" value="Run Flag Importer">
        </td>
      
        </td>

    </tr>
</table>

<?php
include('Common/Templates/tail.php');
?>