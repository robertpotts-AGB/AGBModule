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

if(array_key_exists('test',$_POST)) {
    setyhb();
}

if(array_key_exists('EvCode',$_POST)){
    setBookingInRef();
}
if(array_key_exists('OldCode',$_POST)){
    replace_in_file();
}

if(array_key_exists('DocVersMin',$_POST)){
SetVersions();
}

function setyhb()
{
    /**  Collect current event, set base event info */
    $Tour11 = $_SESSION['TourId'];
    $updQuery = "UPDATE Tournament SET ToNumDist = '3',ToMaxDistScore='648',ToNumEnds='12',ToXNine='Golds',ToXNineChars='J',ToGolds='Hits',ToGoldsChars='BDFHJ', ToCategory='1'WHERE ToID ='$Tour11'";
    $updateTournament = safe_r_sql($updQuery);

    echo "Setting Base Info";
    echo "<br>";
    echo "Setting scorecard terminology";
    echo "<br>";

    /**  Setup Distance Parameters */
    $DropDistances = "DELETE FROM DistanceInformation WHERE DiTournament= $Tour11";

    echo "Removing Distances";
    echo "<br>";

    $updQuery2 = "INSERT INTO DistanceInformation SET DiSession='1', DiEnds='12', DiArrows='6',DiTournament= $Tour11, DiDistance='1'";
    $updQuery3 = "INSERT INTO DistanceInformation SET DiSession='1', DiEnds='8', DiArrows='6', DiTournament= $Tour11, DiDistance='2'";
    $updQuery4 = "INSERT INTO DistanceInformation SET DiSession='1', DiEnds='4', DiArrows='6', DiTournament= $Tour11, DiDistance='3'";

    $updateDistances = safe_r_sql($DropDistances);
    $updateD1 = safe_r_sql($updQuery2);
    $updateD2 = safe_r_sql($updQuery3);
    $updateD3 = safe_r_sql($updQuery4);

    echo "Setting number of Arrows per distance";
    echo "<br>";

    /** Create Class for M+W */
    $UpdateClassM = "REPLACE INTO Classes SET ClId='M',ClTournament='$Tour11',ClDescription='Gentlemen',ClViewOrder='9',ClAgeFrom='19',ClAgeTo='100',ClValidClass='M',ClSex='0',ClAthlete='1',ClRecClass='M',ClWaClass='M',ClTourRules='UK|Type_Indoor 18|SetUkJunNationals' ";
    $UpdateClassW = "REPLACE INTO Classes SET ClId='W',ClTournament='$Tour11',ClDescription='Ladies',ClViewOrder='10',ClAgeFrom='19',ClAgeTo='100',ClValidClass='W',ClSex='1',ClAthlete='1',ClRecClass='W',ClWaClass='W',ClTourRules='UK|Type_Indoor 18|SetUkJunNationals' ";

    $updateClass = safe_r_sql($UpdateClassM);
    $updateClass = safe_r_sql($UpdateClassW);

    echo "Setting additional classes";
    echo "<br>";

    /**  Setup Distances for each category */

    $removeDist = "DELETE FROM TournamentDistances WHERE TdTournament=$Tour11";
    $UpdateM = "REPLACE INTO TournamentDistances SET TdClasses='_M', TDType='6',TDTournament= '$Tour11',Td1='100y',Td2='80y',Td3='60y'";
    $UpdateW = "REPLACE INTO TournamentDistances SET TdClasses='_W', TDType='6',TDTournament= '$Tour11',Td1='80y',Td2='60y',Td3='50y'";
    $UpdateS1 = "REPLACE INTO TournamentDistances SET TdClasses='_S1', TDType='6',TDTournament= '$Tour11',Td1='80y',Td2='60y',Td3='50y'";
    $UpdateS2 = "REPLACE INTO TournamentDistances SET TdClasses='_S2', TDType='6',TDTournament= '$Tour11',Td1='60y',Td2='50y',Td3='40y'";
    $UpdateS3 = "REPLACE INTO TournamentDistances SET TdClasses='_S3', TDType='6',TDTournament= '$Tour11',Td1='60y',Td2='50y',Td3='40y'";
    $UpdateS4 = "REPLACE INTO TournamentDistances SET TdClasses='_S4', TDType='6',TDTournament= '$Tour11',Td1='50y',Td2='40y',Td3='30y'";
    $UpdateS5 = "REPLACE INTO TournamentDistances SET TdClasses='_S5', TDType='6',TDTournament= '$Tour11',Td1='50y',Td2='40y',Td3='30y'";
    $UpdateS6 = "REPLACE INTO TournamentDistances SET TdClasses='_S6', TDType='6',TDTournament= '$Tour11',Td1='40y',Td2='30y',Td3='20y'";
    $UpdateS7 = "REPLACE INTO TournamentDistances SET TdClasses='_S7', TDType='6',TDTournament= '$Tour11',Td1='40y',Td2='30y',Td3='20y'";
    $UpdateS8 = "REPLACE INTO TournamentDistances SET TdClasses='_S8', TDType='6',TDTournament= '$Tour11',Td1='30y',Td2='20y',Td3='10y'";


    $removeDistance = safe_r_SQL($removeDist);
    $updateRounds = safe_r_sql($UpdateS1);
    $updateRounds = safe_r_sql($UpdateS2);
    $updateRounds = safe_r_sql($UpdateS3);
    $updateRounds = safe_r_sql($UpdateS4);
    $updateRounds = safe_r_sql($UpdateS5);
    $updateRounds = safe_r_sql($UpdateS6);
    $updateRounds = safe_r_sql($UpdateS7);
    $updateRounds = safe_r_sql($UpdateS8);
    $updateRounds = safe_r_sql($UpdateM);
    $updateRounds = safe_r_sql($UpdateW);

    echo "Setting Tournament Distance defaults";
    echo "<br>";

    /** Setup Target Face */
    $TfRemove = "DELETE FROM TargetFaces WHERE TfTournament ='$Tour11'";
    $Tfupdate = "REPLACE INTO TargetFaces SET TfId ='1',TfName='All', TfTournament= '$Tour11', TfClasses='%', TfGolds='Hits',TfXNine='Golds', TfGoldsChars='BDFHJ', TfXNineChars='J',TfT1='5',TfW1='122',TfT2='5',TfW2='122',TfT3='5',TfW3='122',TfDefault='1',TfTourRules='UK|Type_Indoor 18|SetUkJunNationals'";

    $updateTargets = safe_r_sql($TfRemove);
    $updateTargets = safe_r_sql($Tfupdate);

    echo "Replacing Target Face";
    echo "<br>";

    echo "Done! Please check the event setup to ensure it is correct";

    /** TODO: WRITE AUTO EVENT CREATION BASED ON ARRAY OF BOWSTYLE AND CLASS */

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
function SetVersions(){
    $Tour11 = $_SESSION['TourId'];
    $MajVer = ($_POST['DocVersMaj']);
    $MinVer = ($_POST['DocVersMin']);
    $DocNote = ($_POST['Notes']);
    $CurrTime = date('Y-m-d H:i:s');
    if(is_null($MajVer)){
        $UpdateSCHED = "REPLACE INTO DocumentVersions SET DvTournament='$Tour11',DvFile='SCHED',DvMinVersion='$MinVer',DvPrintDateTime='$CurrTime',DvIncludedDateTime='$CurrTime',DvNotes='$DocNote'";
        $UpdateFOP = "REPLACE INTO DocumentVers
  ions SET DvTournament='$Tour11', DvFile='FOP',DvMinVersion='$MinVer',DvPrintDateTime='$CurrTime',DvIncludedDateTime='$CurrTime',DvNotes='$DocNote'";
    }
    else {
        $UpdateSCHED = "REPLACE INTO DocumentVersions SET DvTournament='$Tour11',DvFile='SCHED',DvMajVersion='$MajVer',DvMinVersion='$MinVer',DvPrintDateTime='$CurrTime',DvIncludedDateTime='$CurrTime',DvNotes='$DocNote'";
        $UpdateFOP = "REPLACE INTO DocumentVersions SET DvTournament='$Tour11', DvFile='FOP',DvMajVersion='$MajVer',DvMinVersion='$MinVer',DvPrintDateTime='$CurrTime',DvIncludedDateTime='$CurrTime',DvNotes='$DocNote'";
    }

    $updateSC = safe_r_sql($UpdateSCHED);
    $updateFP = safe_r_sql($UpdateFOP);


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
        <td>
            It is important that you have configured a WA18 under AGB Rules with the 'Junior Championships' subclass before proceeding further
        </td>
        <td>

            <form method="post">
                <input style="border-radius:8px;font-size:16px;background-color: orangered;color: white; padding: 15px 32px;" type="submit" name="test" id="test" value="Set up Y/H/B Event" /><br/>
            </form>
        </td>
    </tr>
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
            <h2> Schedule Version</h2>
            <h3> Specify the Schedule and FOP versions, and any notes associated and click 'Set Version'</h3>
        </td>

        <td align="center">
            <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                <p>Major Version: <input style="font-size:16px" type="Text" name="DocVersMaj"></p>
                <p>Minor Version: <input style="font-size:16px" type="Text" name="DocVersMin"></p>
               <td><p>Notes: <input style="font-size:16px" type="Text" name="Notes"></p></td>
        <td> <input style="border-radius:8px;font-size:16px;background-color: Green;color: white; padding: 15px 32px;" type="submit" value="Set Version">
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