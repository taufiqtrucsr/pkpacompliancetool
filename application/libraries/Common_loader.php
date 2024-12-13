<?php 
//require_once(APPPATH.'third_party/phpqrcode/qrlib.php');
require_once(APPPATH.'third_party/tcpdf/tcpdf.php');

defined('BASEPATH') OR exit('No direct script access allowed.');

class Common_loader
{
    protected $CI;

    public function __construct()
    {
		$this->CI =& get_instance(); //read manual: create libraries

		$this->CI->load->model('CommonModel');
		//$this->CI->load->model('CategoryModel');
        
        $dataX = array(); // set here all your vars to views

        //$dataX['ProductCategories'] = $this->CI->CategoryModel->getAllProductCategories();
		
		$dataX['rsegments'] = $this->CI->uri->rsegments[1];

        $this->CI->load->vars($dataX);
    }
	
	
	public function GeneratePdf($pdf_content,$pdf_file_name) {
 
// create new PDF document
$Subject  = "PDF Test";

$colWidth = array("5%","33%","6%","10%","10%","6%" ,"6%" ,"6%" ,"6%","7%");
$colWidth = array("6%","33%","11%","15%","15%","11%","9%" );

$HeadTbl = '<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:dt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 15">
<meta name=Originator content="Microsoft Word 15">
<link rel=File-List
href="Draft%20Agreement%20Contributor%20&amp;%20Implementor_files/filelist.xml">
<link rel=Edit-Time-Data
href="Draft%20Agreement%20Contributor%20&amp;%20Implementor_files/editdata.mso">
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
w\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>Satish Hegde</o:Author>
  <o:LastAuthor>hp</o:LastAuthor>
  <o:Revision>2</o:Revision>
  <o:TotalTime>2</o:TotalTime>
  <o:LastPrinted>2020-01-09T13:47:00Z</o:LastPrinted>
  <o:Created>2020-05-06T04:39:00Z</o:Created>
  <o:LastSaved>2020-05-06T04:39:00Z</o:LastSaved>
  <o:Pages>20</o:Pages>
  <o:Words>7229</o:Words>
  <o:Characters>41208</o:Characters>
  <o:Lines>343</o:Lines>
  <o:Paragraphs>96</o:Paragraphs>
  <o:CharactersWithSpaces>48341</o:CharactersWithSpaces>
  <o:Version>15.00</o:Version>
 </o:DocumentProperties>
 <o:CustomDocumentProperties>
  <o:Exclude_x0020_Footer dt:dt="string">True</o:Exclude_x0020_Footer>
  <o:Classification_x0020_Type dt:dt="string">Confidential - BoardSecretariat&amp;RegulatoryCompliance</o:Classification_x0020_Type>
 </o:CustomDocumentProperties>
 <o:OfficeDocumentSettings>
  <o:RelyOnVML/>
  <o:AllowPNG/>
 </o:OfficeDocumentSettings>
</xml><![endif]-->
<link rel=dataStoreItem
href="Draft%20Agreement%20Contributor%20&amp;%20Implementor_files/item0001.xml"
target="Draft%20Agreement%20Contributor%20&amp;%20Implementor_files/props002.xml">
<link rel=themeData
href="Draft%20Agreement%20Contributor%20&amp;%20Implementor_files/themedata.thmx">
<link rel=colorSchemeMapping
href="Draft%20Agreement%20Contributor%20&amp;%20Implementor_files/colorschememapping.xml">
<!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:ActiveWritingStyle Lang="EN-US" VendorID="64" DLLVersion="4096" NLCheck="1">0</w:ActiveWritingStyle>
  <w:ActiveWritingStyle Lang="EN-US" VendorID="64" DLLVersion="131078"
   NLCheck="1">1</w:ActiveWritingStyle>
  <w:TrackMoves>false</w:TrackMoves>
  <w:TrackFormatting/>
  <w:PunctuationKerning/>
  <w:ValidateAgainstSchemas/>
  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>
  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
  <w:DoNotPromoteQF/>
  <w:LidThemeOther>EN-IN</w:LidThemeOther>
  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>
  <w:LidThemeComplexScript>HI</w:LidThemeComplexScript>
  <w:Compatibility>
   <w:BreakWrappedTables/>
   <w:SnapToGridInCell/>
   <w:WrapTextWithPunct/>
   <w:UseAsianBreakRules/>
   <w:DontGrowAutofit/>
   <w:SplitPgBreakAndParaMark/>
   <w:EnableOpenTypeKerning/>
   <w:DontFlipMirrorIndents/>
   <w:OverrideTableStyleHps/>
  </w:Compatibility>
  <m:mathPr>
   <m:mathFont m:val="Cambria Math"/>
   <m:brkBin m:val="before"/>
   <m:brkBinSub m:val="&#45;-"/>
   <m:smallFrac m:val="off"/>
   <m:dispDef/>
   <m:lMargin m:val="0"/>
   <m:rMargin m:val="0"/>
   <m:defJc m:val="centerGroup"/>
   <m:wrapIndent m:val="1440"/>
   <m:intLim m:val="subSup"/>
   <m:naryLim m:val="undOvr"/>
  </m:mathPr></w:WordDocument>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="false"
  DefSemiHidden="false" DefQFormat="false" DefPriority="99"
  LatentStyleCount="371">
  <w:LsdException Locked="false" Priority="0" QFormat="true" Name="Normal"/>
  <w:LsdException Locked="false" Priority="0" QFormat="true" Name="heading 1"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 2"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 3"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 4"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 5"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 6"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 7"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 8"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 9"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 6"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 7"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 8"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 9"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 1"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 2"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 3"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 4"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 5"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 6"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 7"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 8"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 9"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Normal Indent"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="footnote text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="annotation text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="header"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="footer"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index heading"/>
  <w:LsdException Locked="false" Priority="35" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="caption"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="table of figures"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="envelope address"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="envelope return"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="footnote reference"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="annotation reference"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="line number"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="page number"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="endnote reference"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="endnote text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="table of authorities"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="macro"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="toa heading"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number 5"/>
  <w:LsdException Locked="false" Priority="10" QFormat="true" Name="Title"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Closing"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Signature"/>
  <w:LsdException Locked="false" Priority="1" SemiHidden="true"
   UnhideWhenUsed="true" Name="Default Paragraph Font"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" Name="Body Text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text Indent"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Message Header"/>
  <w:LsdException Locked="false" Priority="11" QFormat="true" Name="Subtitle"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Salutation"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Date"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text First Indent"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text First Indent 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Note Heading"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text Indent 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text Indent 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Block Text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Hyperlink"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="FollowedHyperlink"/>
  <w:LsdException Locked="false" Priority="22" QFormat="true" Name="Strong"/>
  <w:LsdException Locked="false" Priority="20" QFormat="true" Name="Emphasis"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Document Map"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Plain Text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="E-mail Signature"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Top of Form"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Bottom of Form"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Normal (Web)"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Acronym"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Address"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Cite"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Code"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Definition"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Keyboard"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Preformatted"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Sample"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Typewriter"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Variable"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Normal Table"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="annotation subject"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="No List"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Outline List 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Outline List 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Outline List 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Simple 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Simple 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Simple 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Colorful 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Colorful 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Colorful 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 6"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 7"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 8"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 6"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 7"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 8"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table 3D effects 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table 3D effects 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table 3D effects 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Contemporary"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Elegant"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Professional"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Subtle 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Subtle 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Web 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Web 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Web 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Balloon Text"/>
  <w:LsdException Locked="false" Priority="59" Name="Table Grid"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Theme"/>
  <w:LsdException Locked="false" SemiHidden="true" Name="Placeholder Text"/>
  <w:LsdException Locked="false" Priority="1" QFormat="true" Name="No Spacing"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 1"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 1"/>
  <w:LsdException Locked="false" SemiHidden="true" Name="Revision"/>
  <w:LsdException Locked="false" Priority="0" QFormat="true"
   Name="List Paragraph"/>
  <w:LsdException Locked="false" Priority="29" QFormat="true" Name="Quote"/>
  <w:LsdException Locked="false" Priority="30" QFormat="true"
   Name="Intense Quote"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 1"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 1"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 2"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 2"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 2"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 3"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 3"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 3"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 4"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 4"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 4"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 5"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 5"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 5"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 6"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 6"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 6"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="19" QFormat="true"
   Name="Subtle Emphasis"/>
  <w:LsdException Locked="false" Priority="21" QFormat="true"
   Name="Intense Emphasis"/>
  <w:LsdException Locked="false" Priority="31" QFormat="true"
   Name="Subtle Reference"/>
  <w:LsdException Locked="false" Priority="32" QFormat="true"
   Name="Intense Reference"/>
  <w:LsdException Locked="false" Priority="33" QFormat="true" Name="Book Title"/>
  <w:LsdException Locked="false" Priority="37" SemiHidden="true"
   UnhideWhenUsed="true" Name="Bibliography"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="TOC Heading"/>
  <w:LsdException Locked="false" Priority="41" Name="Plain Table 1"/>
  <w:LsdException Locked="false" Priority="42" Name="Plain Table 2"/>
  <w:LsdException Locked="false" Priority="43" Name="Plain Table 3"/>
  <w:LsdException Locked="false" Priority="44" Name="Plain Table 4"/>
  <w:LsdException Locked="false" Priority="45" Name="Plain Table 5"/>
  <w:LsdException Locked="false" Priority="40" Name="Grid Table Light"/>
  <w:LsdException Locked="false" Priority="46" Name="Grid Table 1 Light"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark"/>
  <w:LsdException Locked="false" Priority="51" Name="Grid Table 6 Colorful"/>
  <w:LsdException Locked="false" Priority="52" Name="Grid Table 7 Colorful"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 1"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 1"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 1"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 2"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 2"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 2"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 3"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 3"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 3"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 4"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 4"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 4"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 5"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 5"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 5"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 6"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 6"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 6"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 6"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 6"/>
  <w:LsdException Locked="false" Priority="46" Name="List Table 1 Light"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark"/>
  <w:LsdException Locked="false" Priority="51" Name="List Table 6 Colorful"/>
  <w:LsdException Locked="false" Priority="52" Name="List Table 7 Colorful"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 1"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 1"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 1"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 2"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 2"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 2"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 3"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 3"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 3"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 4"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 4"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 4"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 5"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 5"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 5"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 6"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 6"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 6"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 6"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 6"/>
 </w:LatentStyles>
</xml><![endif]-->
<link rel=plchdr
href="Draft%20Agreement%20Contributor%20&amp;%20Implementor_files/plchdr.htm">
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Wingdings;
	panose-1:5 0 0 0 0 0 0 0 0 0;
	mso-font-charset:2;
	mso-generic-font-family:auto;
	mso-font-pitch:variable;
	mso-font-signature:0 268435456 0 0 -2147483648 0;}
@font-face
	{font-family:"MS Gothic";
	panose-1:2 11 6 9 7 2 5 8 2 4;
	mso-font-alt:"\FF2D\FF33 \30B4\30B7\30C3\30AF";
	mso-font-charset:128;
	mso-generic-font-family:modern;
	mso-font-pitch:fixed;
	mso-font-signature:-536870145 1791491579 134217746 0 131231 0;}
@font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;
	mso-font-charset:0;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:-536869121 1107305727 33554432 0 415 0;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-469750017 -1073732485 9 0 511 0;}
@font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-520081665 -1073717157 41 0 66047 0;}
@font-face
	{font-family:DINPro-Regular;
	panose-1:0 0 0 0 0 0 0 0 0 0;
	mso-font-alt:Calibri;
	mso-font-charset:0;
	mso-generic-font-family:modern;
	mso-font-format:other;
	mso-font-pitch:variable;
	mso-font-signature:-2147482961 1073750122 0 0 159 0;}
@font-face
	{font-family:"Segoe UI Symbol";
	panose-1:2 11 5 2 4 2 4 2 2 3;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-2147483165 302055407 262144 0 1 0;}
@font-face
	{font-family:"\@MS Gothic";
	panose-1:2 11 6 9 7 2 5 8 2 4;
	mso-font-charset:128;
	mso-generic-font-family:modern;
	mso-font-pitch:fixed;
	mso-font-signature:-536870145 1791491579 134217746 0 131231 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Times New Roman";}
h1
	{mso-style-name:"Heading 1\,Head1\,Heading apps\,H1\,h1\,1\,No numbers\,Part\,section 1\,Heading appendix\,Section Heading\,Chapter Heading\,level 1\,Level 1 Head\,Titre 1 SQ\,PA Chapter\,Level 1\,BP1\,Article\: Heading 1\,Part Title\,Heading 10\,Heading 101\,Head11\,Heading apps1\,Heading 102";
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"Heading 1 Char\,Head1 Char\,Heading apps Char\,H1 Char\,h1 Char\,1 Char\,No numbers Char\,Part Char\,section 1 Char\,Heading appendix Char\,Section Heading Char\,Chapter Heading Char\,level 1 Char\,Level 1 Head Char\,Titre 1 SQ Char\,PA Chapter Char\,Level 1 Char";
	mso-style-next:Normal;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	text-align:justify;
	text-indent:-.5in;
	mso-pagination:widow-orphan;
	page-break-after:avoid;
	mso-outline-level:1;
	mso-list:l7 level1 lfo1;
	font-size:11.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";
	mso-font-kerning:0pt;}
h2
	{mso-style-name:"Heading 2\,h2\,2m\,H2\,SD 2\,Heading2\,L2\,H21\,2\,Heading\,RFP\,Main\,RFP Heading 2\,Main Heading\,heading5\,h21\,h22\,Level 2 Topic Heading\,section 1\.1\,Heading 2- no\#\,Chapter Title\,Section\,m\,Body Text \(Reset numbering\)\,Reset numbering\,TF-Overskrit 2\,h2 main heading\,l2";
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"Heading 2 Char\,h2 Char\,2m Char\,H2 Char\,SD 2 Char\,Heading2 Char\,L2 Char\,H21 Char\,2 Char\,Heading Char\,RFP Char\,Main Char\,RFP Heading 2 Char\,Main Heading Char\,heading5 Char\,h21 Char\,h22 Char\,Level 2 Topic Heading Char\,section 1\.1 Char\,Heading 2- no\# Char";
	mso-style-next:Normal;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	text-align:justify;
	text-indent:-.5in;
	mso-pagination:none;
	mso-outline-level:2;
	mso-list:l7 level2 lfo1;
	mso-layout-grid-align:none;
	text-autospace:none;
	font-size:11.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:Arial;
	font-weight:normal;
	mso-bidi-font-weight:bold;}
h3
	{mso-style-name:"Heading 3\,h3\,\(Alt+3\)\,Head 3\,heading 3\,h31\,h32\,H3\,H31\,Table Attribute Heading\,L3\,Hd2\,\(Alt+3\)1\,\(Alt+3\)2\,\(Alt+3\)3\,\(Alt+3\)4\,\(Alt+3\)5\,\(Alt+3\)6\,\(Alt+3\)11\,\(Alt+3\)21\,\(Alt+3\)31\,\(Alt+3\)41\,\(Alt+3\)7\,\(Alt+3\)12\,\(Alt+3\)22\,\(Alt+3\)32\,\(Alt+3\)42\,\(Alt+3\)8\,\(Alt+3\)9\,3\,H32\,l3";
	mso-style-update:auto;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"Heading 3 Char\,h3 Char\,\(Alt+3\) Char\,Head 3 Char\,heading 3 Char\,h31 Char\,h32 Char\,H3 Char\,H31 Char\,Table Attribute Heading Char\,L3 Char\,Hd2 Char\,\(Alt+3\)1 Char\,\(Alt+3\)2 Char\,\(Alt+3\)3 Char\,\(Alt+3\)4 Char\,\(Alt+3\)5 Char\,\(Alt+3\)6 Char\,\(Alt+3\)11 Char\,3 Char";
	mso-style-next:Normal;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	mso-add-space:auto;
	text-align:justify;
	line-height:150%;
	mso-pagination:widow-orphan;
	mso-outline-level:3;
	tab-stops:35.45pt;
	font-size:11.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	font-weight:normal;
	mso-bidi-font-weight:bold;}
h3.CxSpFirst
	{mso-style-name:"Heading 3\,h3\,\(Alt+3\)\,Head 3\,heading 3\,h31\,h32\,H3\,H31\,Table Attribute Heading\,L3\,Hd2\,\(Alt+3\)1\,\(Alt+3\)2\,\(Alt+3\)3\,\(Alt+3\)4\,\(Alt+3\)5\,\(Alt+3\)6\,\(Alt+3\)11\,\(Alt+3\)21\,\(Alt+3\)31\,\(Alt+3\)41\,\(Alt+3\)7\,\(Alt+3\)12\,\(Alt+3\)22\,\(Alt+3\)32\,\(Alt+3\)42\,\(Alt+3\)8\,\(Alt+3\)9\,3\,H32\,l3Cx";
	mso-style-update:auto;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"Heading 3 Char\,h3 Char\,\(Alt+3\) Char\,Head 3 Char\,heading 3 Char\,h31 Char\,h32 Char\,H3 Char\,H31 Char\,Table Attribute Heading Char\,L3 Char\,Hd2 Char\,\(Alt+3\)1 Char\,\(Alt+3\)2 Char\,\(Alt+3\)3 Char\,\(Alt+3\)4 Char\,\(Alt+3\)5 Char\,\(Alt+3\)6 Char\,\(Alt+3\)11 Char\,3 Char";
	mso-style-next:Normal;
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	mso-add-space:auto;
	text-align:justify;
	line-height:150%;
	mso-pagination:widow-orphan;
	mso-outline-level:3;
	tab-stops:35.45pt;
	font-size:11.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	font-weight:normal;
	mso-bidi-font-weight:bold;}
h3.CxSpMiddle
	{mso-style-name:"Heading 3\,h3\,\(Alt+3\)\,Head 3\,heading 3\,h31\,h32\,H3\,H31\,Table Attribute Heading\,L3\,Hd2\,\(Alt+3\)1\,\(Alt+3\)2\,\(Alt+3\)3\,\(Alt+3\)4\,\(Alt+3\)5\,\(Alt+3\)6\,\(Alt+3\)11\,\(Alt+3\)21\,\(Alt+3\)31\,\(Alt+3\)41\,\(Alt+3\)7\,\(Alt+3\)12\,\(Alt+3\)22\,\(Alt+3\)32\,\(Alt+3\)42\,\(Alt+3\)8\,\(Alt+3\)9\,3\,H32\,l3Cx";
	mso-style-update:auto;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"Heading 3 Char\,h3 Char\,\(Alt+3\) Char\,Head 3 Char\,heading 3 Char\,h31 Char\,h32 Char\,H3 Char\,H31 Char\,Table Attribute Heading Char\,L3 Char\,Hd2 Char\,\(Alt+3\)1 Char\,\(Alt+3\)2 Char\,\(Alt+3\)3 Char\,\(Alt+3\)4 Char\,\(Alt+3\)5 Char\,\(Alt+3\)6 Char\,\(Alt+3\)11 Char\,3 Char";
	mso-style-next:Normal;
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	mso-add-space:auto;
	text-align:justify;
	line-height:150%;
	mso-pagination:widow-orphan;
	mso-outline-level:3;
	tab-stops:35.45pt;
	font-size:11.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	font-weight:normal;
	mso-bidi-font-weight:bold;}
h3.CxSpLast
	{mso-style-name:"Heading 3\,h3\,\(Alt+3\)\,Head 3\,heading 3\,h31\,h32\,H3\,H31\,Table Attribute Heading\,L3\,Hd2\,\(Alt+3\)1\,\(Alt+3\)2\,\(Alt+3\)3\,\(Alt+3\)4\,\(Alt+3\)5\,\(Alt+3\)6\,\(Alt+3\)11\,\(Alt+3\)21\,\(Alt+3\)31\,\(Alt+3\)41\,\(Alt+3\)7\,\(Alt+3\)12\,\(Alt+3\)22\,\(Alt+3\)32\,\(Alt+3\)42\,\(Alt+3\)8\,\(Alt+3\)9\,3\,H32\,l3Cx";
	mso-style-update:auto;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"Heading 3 Char\,h3 Char\,\(Alt+3\) Char\,Head 3 Char\,heading 3 Char\,h31 Char\,h32 Char\,H3 Char\,H31 Char\,Table Attribute Heading Char\,L3 Char\,Hd2 Char\,\(Alt+3\)1 Char\,\(Alt+3\)2 Char\,\(Alt+3\)3 Char\,\(Alt+3\)4 Char\,\(Alt+3\)5 Char\,\(Alt+3\)6 Char\,\(Alt+3\)11 Char\,3 Char";
	mso-style-next:Normal;
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	mso-add-space:auto;
	text-align:justify;
	line-height:150%;
	mso-pagination:widow-orphan;
	mso-outline-level:3;
	tab-stops:35.45pt;
	font-size:11.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	font-weight:normal;
	mso-bidi-font-weight:bold;}
h4
	{mso-style-name:"Heading 4\,Khaitan Heading 4";
	mso-style-priority:9;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"Heading 4 Char\,Khaitan Heading 4 Char";
	mso-style-next:Normal;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:1.5in;
	margin-bottom:.0001pt;
	text-align:justify;
	text-indent:-.5in;
	mso-pagination:none;
	mso-outline-level:4;
	mso-list:l7 level4 lfo1;
	mso-layout-grid-align:none;
	text-autospace:none;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";
	font-weight:normal;
	mso-bidi-font-weight:bold;}
h5
	{mso-style-name:"Heading 5\,5\,H5\,h5\,Heading 5prop\,Subheading\,Level 3 - i\,Block Label\,Heading 5-1\,SLA\,Heading 3 Text\, SLA\,1\.1\.1\.1\.1\,mh2\,Module heading 2\,heading 5\,Numbered Sub-list\,\(Level 5 numbered paras\)\,Teal\,i\) ii\) iii\)\,DTS Level 5\,Hd4\,Third Level Heading\,h51\,h52\,Para5";
	mso-style-priority:9;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"Heading 5 Char\,5 Char\,H5 Char\,h5 Char\,Heading 5prop Char\,Subheading Char\,Level 3 - i Char\,Block Label Char\,Heading 5-1 Char\,SLA Char\,Heading 3 Text Char\, SLA Char\,1\.1\.1\.1\.1 Char\,mh2 Char\,Module heading 2 Char\,heading 5 Char\,Numbered Sub-list Char";
	mso-style-next:Normal;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.7in;
	margin-bottom:.0001pt;
	text-align:justify;
	text-indent:-.7in;
	mso-pagination:none;
	mso-outline-level:5;
	mso-list:l7 level5 lfo1;
	mso-layout-grid-align:none;
	text-autospace:none;
	font-size:11.0pt;
	mso-bidi-font-size:13.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";
	font-weight:normal;
	mso-bidi-font-weight:bold;
	mso-bidi-font-style:italic;}
h6
	{mso-style-name:"Heading 6\,6\,H6\,h6\,Appendix\,sub-dash\,sd\,Sub Label\,\(Level 6 numbered paras\)\,H61\,H62\,H63\,H64\,H65\,H66\,H67\,H68\,H69\,H610\,H611\,H612\,H613\,H614\,H615\,H616\,H617\,H618\,H619\,H621\,H631\,H641\,H651\,H661\,H671\,H681\,H691\,H6101\,H6111\,H6121\,H6131\,H6141\,H6151\,H6161\,H6171\,H6181";
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"Heading 6 Char\,6 Char\,H6 Char\,h6 Char\,Appendix Char\,sub-dash Char\,sd Char\,Sub Label Char\,\(Level 6 numbered paras\) Char\,H61 Char\,H62 Char\,H63 Char\,H64 Char\,H65 Char\,H66 Char\,H67 Char\,H68 Char\,H69 Char\,H610 Char\,H611 Char\,H612 Char\,H613 Char\,H614 Char";
	mso-style-next:Normal;
	margin-top:12.0pt;
	margin-right:0in;
	margin-bottom:3.0pt;
	margin-left:.8in;
	text-indent:-.8in;
	mso-pagination:widow-orphan;
	mso-outline-level:6;
	mso-list:l7 level6 lfo1;
	mso-layout-grid-align:none;
	text-autospace:none;
	font-size:11.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Times New Roman";}
p.MsoHeading7, li.MsoHeading7, div.MsoHeading7
	{mso-style-name:"Heading 7\,7\,h7\,\(Level 7 numbered paras\)\,Appendix Major";
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"Heading 7 Char\,7 Char\,h7 Char\,\(Level 7 numbered paras\) Char\,Appendix Major Char";
	mso-style-next:Normal;
	margin-top:12.0pt;
	margin-right:0in;
	margin-bottom:3.0pt;
	margin-left:.9in;
	text-indent:-.9in;
	mso-pagination:widow-orphan;
	mso-outline-level:7;
	mso-list:l7 level7 lfo1;
	mso-layout-grid-align:none;
	text-autospace:none;
	font-size:12.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Times New Roman";}
p.MsoHeading8, li.MsoHeading8, div.MsoHeading8
	{mso-style-name:"Heading 8\,8\,h8\,OurHeadings\,\(Level 8 numbered paras\)\,Appendix Minor";
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"Heading 8 Char\,8 Char\,h8 Char\,OurHeadings Char\,\(Level 8 numbered paras\) Char\,Appendix Minor Char";
	mso-style-next:Normal;
	margin-top:12.0pt;
	margin-right:0in;
	margin-bottom:3.0pt;
	margin-left:1.0in;
	text-indent:-1.0in;
	mso-pagination:widow-orphan;
	mso-outline-level:8;
	mso-list:l7 level8 lfo1;
	mso-layout-grid-align:none;
	text-autospace:none;
	font-size:12.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Times New Roman";
	font-style:italic;}
p.MsoHeading9, li.MsoHeading9, div.MsoHeading9
	{mso-style-name:"Heading 9\,9\,h9\,RFP Reference\,Heading 9x\,\(Level 9 numbered paras\)";
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"Heading 9 Char\,9 Char\,h9 Char\,RFP Reference Char\,Heading 9x Char\,\(Level 9 numbered paras\) Char";
	mso-style-next:Normal;
	margin-top:12.0pt;
	margin-right:0in;
	margin-bottom:3.0pt;
	margin-left:1.1in;
	text-indent:-1.1in;
	mso-pagination:widow-orphan;
	mso-outline-level:9;
	mso-list:l7 level9 lfo1;
	mso-layout-grid-align:none;
	text-autospace:none;
	font-size:11.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Times New Roman";}
p.MsoCommentText, li.MsoCommentText, div.MsoCommentText
	{mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-link:"Comment Text Char";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Times New Roman";}
p.MsoHeader, li.MsoHeader, div.MsoHeader
	{mso-style-priority:99;
	mso-style-link:"Header Char";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	tab-stops:center 225.65pt right 451.3pt;
	font-size:12.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Times New Roman";}
p.MsoFooter, li.MsoFooter, div.MsoFooter
	{mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-link:"Footer Char";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	tab-stops:center 3.0in right 6.0in;
	font-size:10.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Times New Roman";}
span.MsoCommentReference
	{mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-parent:"";
	mso-ansi-font-size:8.0pt;
	mso-bidi-font-size:8.0pt;}
p.MsoBodyText, li.MsoBodyText, div.MsoBodyText
	{mso-style-unhide:no;
	mso-style-link:"Body Text Char";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Times New Roman";}
a:link, span.MsoHyperlink
	{mso-style-noshow:yes;
	mso-style-priority:99;
	color:blue;
	mso-themecolor:hyperlink;
	text-decoration:underline;
	text-underline:single;}
a:visited, span.MsoHyperlinkFollowed
	{mso-style-noshow:yes;
	mso-style-priority:99;
	color:purple;
	mso-themecolor:followedhyperlink;
	text-decoration:underline;
	text-underline:single;}
p.MsoCommentSubject, li.MsoCommentSubject, div.MsoCommentSubject
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-parent:"Comment Text";
	mso-style-link:"Comment Subject Char";
	mso-style-next:"Comment Text";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Times New Roman";
	font-weight:bold;}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:"Balloon Text Char";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:8.0pt;
	font-family:"Tahoma",sans-serif;
	mso-fareast-font-family:"Times New Roman";}
span.MsoPlaceholderText
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	color:gray;}
p.MsoRMPane, li.MsoRMPane, div.MsoRMPane
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-parent:"";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Times New Roman";}
p.MsoListParagraph, li.MsoListParagraph, div.MsoListParagraph
	{mso-style-name:"List Paragraph\,Bullet List\,FooterText\,Bulet Para\,d_bodyb\,numbered\,List Paragraph1\,Paragraphe de liste1\,Bulletr List Paragraph\,\5217\51FA\6BB5\843D\,\5217\51FA\6BB5\843D1";
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"List Paragraph Char\,Bullet List Char\,FooterText Char\,Bulet Para Char\,d_bodyb Char\,numbered Char\,List Paragraph1 Char\,Paragraphe de liste1 Char\,Bulletr List Paragraph Char\,\5217\51FA\6BB5\843D Char\,\5217\51FA\6BB5\843D1 Char";
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";}
p.MsoIntenseQuote, li.MsoIntenseQuote, div.MsoIntenseQuote
	{mso-style-priority:30;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"Intense Quote Char";
	mso-style-next:Normal;
	margin-top:.25in;
	margin-right:.6in;
	margin-bottom:.25in;
	margin-left:.6in;
	text-align:center;
	mso-pagination:widow-orphan;
	border:none;
	mso-border-top-alt:solid #4F81BD .5pt;
	mso-border-top-themecolor:accent1;
	mso-border-bottom-alt:solid #4F81BD .5pt;
	mso-border-bottom-themecolor:accent1;
	padding:0in;
	mso-padding-alt:10.0pt 0in 10.0pt 0in;
	font-size:12.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Times New Roman";
	color:#4F81BD;
	mso-themecolor:accent1;
	mso-ansi-language:EN-IN;
	font-style:italic;}
span.Heading1Char
	{mso-style-name:"Heading 1 Char\,Head1 Char\,Heading apps Char\,H1 Char\,h1 Char\,1 Char\,No numbers Char\,Part Char\,section 1 Char\,Heading appendix Char\,Section Heading Char\,Chapter Heading Char\,level 1 Char\,Level 1 Head Char\,Titre 1 SQ Char\,PA Chapter Char\,Level 1 Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Heading 1\,Head1\,Heading apps\,H1\,h1\,1\,No numbers\,Part\,section 1\,Heading appendix\,Section Heading\,Chapter Heading\,level 1\,Level 1 Head\,Titre 1 SQ\,PA Chapter\,Level 1\,BP1\,Article\: Heading 1\,Part Title\,Heading 10\,Heading 101\,Head11\,Heading apps1\,Heading 102";
	mso-bidi-font-size:12.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";
	mso-ansi-language:EN-US;
	font-weight:bold;}
span.Heading2Char
	{mso-style-name:"Heading 2 Char\,h2 Char\,2m Char\,H2 Char\,SD 2 Char\,Heading2 Char\,L2 Char\,H21 Char\,2 Char\,Heading Char\,RFP Char\,Main Char\,RFP Heading 2 Char\,Main Heading Char\,heading5 Char\,h21 Char\,h22 Char\,Level 2 Topic Heading Char\,section 1\.1 Char\,Heading 2- no\# Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Heading 2\,h2\,2m\,H2\,SD 2\,Heading2\,L2\,H21\,2\,Heading\,RFP\,Main\,RFP Heading 2\,Main Heading\,heading5\,h21\,h22\,Level 2 Topic Heading\,section 1\.1\,Heading 2- no\#\,Chapter Title\,Section\,m\,Body Text \(Reset numbering\)\,Reset numbering\,TF-Overskrit 2\,h2 main heading\,l2";
	mso-bidi-font-size:12.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:Calibri;
	mso-bidi-font-family:Arial;
	mso-ansi-language:EN-US;
	mso-bidi-font-weight:bold;}
span.Heading3Char
	{mso-style-name:"Heading 3 Char\,h3 Char\,\(Alt+3\) Char\,Head 3 Char\,heading 3 Char\,h31 Char\,h32 Char\,H3 Char\,H31 Char\,Table Attribute Heading Char\,L3 Char\,Hd2 Char\,\(Alt+3\)1 Char\,\(Alt+3\)2 Char\,\(Alt+3\)3 Char\,\(Alt+3\)4 Char\,\(Alt+3\)5 Char\,\(Alt+3\)6 Char\,\(Alt+3\)11 Char\,3 Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Heading 3\,h3\,\(Alt+3\)\,Head 3\,heading 3\,h31\,h32\,H3\,H31\,Table Attribute Heading\,L3\,Hd2\,\(Alt+3\)1\,\(Alt+3\)2\,\(Alt+3\)3\,\(Alt+3\)4\,\(Alt+3\)5\,\(Alt+3\)6\,\(Alt+3\)11\,\(Alt+3\)21\,\(Alt+3\)31\,\(Alt+3\)41\,\(Alt+3\)7\,\(Alt+3\)12\,\(Alt+3\)22\,\(Alt+3\)32\,\(Alt+3\)42\,\(Alt+3\)8\,\(Alt+3\)9\,3\,H32\,l3";
	mso-bidi-font-size:12.0pt;
	font-family:"Arial",sans-serif;
	mso-ascii-font-family:Arial;
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:Arial;
	mso-bidi-font-family:Arial;
	mso-ansi-language:EN-US;
	mso-bidi-font-weight:bold;}
span.Heading4Char
	{mso-style-name:"Heading 4 Char\,Khaitan Heading 4 Char";
	mso-style-priority:9;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Heading 4\,Khaitan Heading 4";
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";
	mso-ansi-language:EN-US;
	mso-bidi-font-weight:bold;}
span.Heading5Char
	{mso-style-name:"Heading 5 Char\,5 Char\,H5 Char\,h5 Char\,Heading 5prop Char\,Subheading Char\,Level 3 - i Char\,Block Label Char\,Heading 5-1 Char\,SLA Char\,Heading 3 Text Char\, SLA Char\,1\.1\.1\.1\.1 Char\,mh2 Char\,Module heading 2 Char\,heading 5 Char\,Numbered Sub-list Char";
	mso-style-priority:9;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Heading 5\,5\,H5\,h5\,Heading 5prop\,Subheading\,Level 3 - i\,Block Label\,Heading 5-1\,SLA\,Heading 3 Text\, SLA\,1\.1\.1\.1\.1\,mh2\,Module heading 2\,heading 5\,Numbered Sub-list\,\(Level 5 numbered paras\)\,Teal\,i\) ii\) iii\)\,DTS Level 5\,Hd4\,Third Level Heading\,h51\,h52\,Para5";
	mso-bidi-font-size:13.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";
	mso-ansi-language:EN-US;
	mso-bidi-font-weight:bold;
	mso-bidi-font-style:italic;}
span.Heading6Char
	{mso-style-name:"Heading 6 Char\,6 Char\,H6 Char\,h6 Char\,Appendix Char\,sub-dash Char\,sd Char\,Sub Label Char\,\(Level 6 numbered paras\) Char\,H61 Char\,H62 Char\,H63 Char\,H64 Char\,H65 Char\,H66 Char\,H67 Char\,H68 Char\,H69 Char\,H610 Char\,H611 Char\,H612 Char\,H613 Char\,H614 Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Heading 6\,6\,H6\,h6\,Appendix\,sub-dash\,sd\,Sub Label\,\(Level 6 numbered paras\)\,H61\,H62\,H63\,H64\,H65\,H66\,H67\,H68\,H69\,H610\,H611\,H612\,H613\,H614\,H615\,H616\,H617\,H618\,H619\,H621\,H631\,H641\,H651\,H661\,H671\,H681\,H691\,H6101\,H6111\,H6121\,H6131\,H6141\,H6151\,H6161\,H6171\,H6181";
	font-family:"Times New Roman",serif;
	mso-ascii-font-family:"Times New Roman";
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";
	mso-ansi-language:EN-US;
	font-weight:bold;}
span.Heading7Char
	{mso-style-name:"Heading 7 Char\,7 Char\,h7 Char\,\(Level 7 numbered paras\) Char\,Appendix Major Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Heading 7\,7\,h7\,\(Level 7 numbered paras\)\,Appendix Major";
	mso-ansi-font-size:12.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Times New Roman",serif;
	mso-ascii-font-family:"Times New Roman";
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";
	mso-ansi-language:EN-US;}
span.Heading8Char
	{mso-style-name:"Heading 8 Char\,8 Char\,h8 Char\,OurHeadings Char\,\(Level 8 numbered paras\) Char\,Appendix Minor Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Heading 8\,8\,h8\,OurHeadings\,\(Level 8 numbered paras\)\,Appendix Minor";
	mso-ansi-font-size:12.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Times New Roman",serif;
	mso-ascii-font-family:"Times New Roman";
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";
	mso-ansi-language:EN-US;
	font-style:italic;}
span.Heading9Char
	{mso-style-name:"Heading 9 Char\,9 Char\,h9 Char\,RFP Reference Char\,Heading 9x Char\,\(Level 9 numbered paras\) Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Heading 9\,9\,h9\,RFP Reference\,Heading 9x\,\(Level 9 numbered paras\)";
	font-family:"Arial",sans-serif;
	mso-ascii-font-family:Arial;
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:Arial;
	mso-bidi-font-family:Arial;
	mso-ansi-language:EN-US;}
span.BodyTextChar
	{mso-style-name:"Body Text Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Body Text";
	mso-bidi-font-size:12.0pt;
	font-family:"Times New Roman",serif;
	mso-ascii-font-family:"Times New Roman";
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";
	mso-ansi-language:EN-US;}
span.FooterChar
	{mso-style-name:"Footer Char";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:Footer;
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Times New Roman",serif;
	mso-ascii-font-family:"Times New Roman";
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";
	mso-ansi-language:EN-US;}
span.CommentTextChar
	{mso-style-name:"Comment Text Char";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Comment Text";
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Times New Roman",serif;
	mso-ascii-font-family:"Times New Roman";
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";
	mso-ansi-language:EN-US;}
span.ListParagraphChar
	{mso-style-name:"List Paragraph Char\,Bullet List Char\,FooterText Char\,Bulet Para Char\,d_bodyb Char\,numbered Char\,List Paragraph1 Char\,Paragraphe de liste1 Char\,Bulletr List Paragraph Char\,\5217\51FA\6BB5\843D Char\,\5217\51FA\6BB5\843D1 Char";
	mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:"";
	mso-style-link:"List Paragraph\,Bullet List\,FooterText\,Bulet Para\,d_bodyb\,numbered\,List Paragraph1\,Paragraphe de liste1\,Bulletr List Paragraph\,\5217\51FA\6BB5\843D\,\5217\51FA\6BB5\843D1";
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-fareast-font-family:Calibri;
	mso-hansi-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";
	mso-ansi-language:EN-US;}
span.BalloonTextChar
	{mso-style-name:"Balloon Text Char";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Balloon Text";
	mso-ansi-font-size:8.0pt;
	mso-bidi-font-size:8.0pt;
	font-family:"Tahoma",sans-serif;
	mso-ascii-font-family:Tahoma;
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:Tahoma;
	mso-bidi-font-family:Tahoma;
	mso-ansi-language:EN-US;}
p.Default, li.Default, div.Default
	{mso-style-name:Default;
	mso-style-unhide:no;
	mso-style-parent:"";
	margin:0in;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	mso-layout-grid-align:none;
	text-autospace:none;
	font-size:12.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-fareast-theme-font:minor-latin;
	color:black;
	mso-ansi-language:EN-IN;}
span.HeaderChar
	{mso-style-name:"Header Char";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:Header;
	mso-ansi-font-size:12.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Times New Roman",serif;
	mso-ascii-font-family:"Times New Roman";
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";
	mso-ansi-language:EN-US;}
span.CommentSubjectChar
	{mso-style-name:"Comment Subject Char";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:"Comment Text Char";
	mso-style-link:"Comment Subject";
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Times New Roman",serif;
	mso-ascii-font-family:"Times New Roman";
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";
	mso-ansi-language:EN-US;
	font-weight:bold;}
span.IntenseQuoteChar
	{mso-style-name:"Intense Quote Char";
	mso-style-priority:30;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Intense Quote";
	mso-ansi-font-size:12.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Times New Roman",serif;
	mso-ascii-font-family:"Times New Roman";
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";
	color:#4F81BD;
	mso-themecolor:accent1;
	font-style:italic;}
.MsoChpDefault
	{mso-style-type:export-only;
	mso-default-props:yes;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:Calibri;
	mso-fareast-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:Mangal;
	mso-bidi-theme-font:minor-bidi;
	mso-ansi-language:EN-IN;}
.MsoPapDefault
	{mso-style-type:export-only;
	margin-bottom:10.0pt;
	line-height:115%;}
 /* Page Definitions */
 @page
	{mso-footnote-separator:url("Draft%20Agreement%20Contributor%20&%20Implementor_files/header.htm") fs;
	mso-footnote-continuation-separator:url("Draft%20Agreement%20Contributor%20&%20Implementor_files/header.htm") fcs;
	mso-endnote-separator:url("Draft%20Agreement%20Contributor%20&%20Implementor_files/header.htm") es;
	mso-endnote-continuation-separator:url("Draft%20Agreement%20Contributor%20&%20Implementor_files/header.htm") ecs;}
@page WordSection1
	{size:8.5in 14.0in;
	margin:1.2in 1.2in 1.2in 1.2in;
	mso-header-margin:.5in;
	mso-footer-margin:1.0in;
	mso-page-numbers:1;
	mso-footer:url("Draft%20Agreement%20Contributor%20&%20Implementor_files/header.htm") f1;
	mso-paper-source:0;}
div.WordSection1
	{page:WordSection1;}
 /* List Definitions */
 @list l0
	{mso-list-id:8723;
	mso-list-type:hybrid;
	mso-list-template-ids:1984747024 -460266668 -974346882 1877507004 1281538006 911523454 2030601830 1614570964 -329590126 -1227583674;}
@list l0:level1
	{mso-level-start-at:9;
	mso-level-number-format:alpha-upper;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l0:level2
	{mso-level-number-format:roman-lower;
	mso-level-text:"\(%2\)";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l0:level3
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l0:level4
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l0:level5
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l0:level6
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l0:level7
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l0:level8
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l0:level9
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l1
	{mso-list-id:9741;
	mso-list-type:hybrid;
	mso-list-template-ids:-238624878 1912661758 844770988 -464345742 1938175262 263350180 1414283310 2147013774 -254496960 -1544503038;}
@list l1:level1
	{mso-level-start-at:35;
	mso-level-number-format:alpha-upper;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l1:level2
	{mso-level-number-format:roman-lower;
	mso-level-text:"\(%2\)";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l1:level3
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l1:level4
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l1:level5
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l1:level6
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l1:level7
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l1:level8
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l1:level9
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l2
	{mso-list-id:27529;
	mso-list-type:hybrid;
	mso-list-template-ids:-401733042 -787862050 -345325348 1211001674 1659958998 601005734 -727040374 -1805985686 -644725470 -1836054954;}
@list l2:level1
	{mso-level-number-format:alpha-upper;
	mso-level-text:%1;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l2:level2
	{mso-level-start-at:2;
	mso-level-number-format:roman-lower;
	mso-level-text:"\(%2\)";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l2:level3
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l2:level4
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l2:level5
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l2:level6
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l2:level7
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l2:level8
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l2:level9
	{mso-level-start-at:0;
	mso-level-text:"";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l3
	{mso-list-id:75782988;
	mso-list-type:hybrid;
	mso-list-template-ids:718721106 67698709 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l3:level1
	{mso-level-number-format:alpha-upper;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l3:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l3:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l3:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l3:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l3:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l3:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l3:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l3:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l4
	{mso-list-id:787822819;
	mso-list-type:hybrid;
	mso-list-template-ids:929092280 67698713 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l4:level1
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l4:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l4:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l4:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l4:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l4:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l4:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l4:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l4:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l5
	{mso-list-id:802623205;
	mso-list-type:hybrid;
	mso-list-template-ids:-623844732 67698709 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l5:level1
	{mso-level-number-format:alpha-upper;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l5:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l5:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l5:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l5:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l5:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l5:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l5:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l5:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l6
	{mso-list-id:891039028;
	mso-list-type:hybrid;
	mso-list-template-ids:919916884 643472478 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l6:level1
	{mso-level-number-format:alpha-lower;
	mso-level-text:"\(%1\)";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.75in;
	text-indent:-.25in;}
@list l6:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.25in;
	text-indent:-.25in;}
@list l6:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:1.75in;
	text-indent:-9.0pt;}
@list l6:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:2.25in;
	text-indent:-.25in;}
@list l6:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:2.75in;
	text-indent:-.25in;}
@list l6:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:3.25in;
	text-indent:-9.0pt;}
@list l6:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:3.75in;
	text-indent:-.25in;}
@list l6:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:4.25in;
	text-indent:-.25in;}
@list l6:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:4.75in;
	text-indent:-9.0pt;}
@list l7
	{mso-list-id:929116339;
	mso-list-template-ids:-859953966;}
@list l7:level1
	{mso-level-style-link:"Heading 1";
	mso-level-text:%1;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.5in;
	mso-ansi-font-size:11.0pt;
	mso-bidi-font-size:11.0pt;
	mso-ansi-font-weight:bold;
	mso-ansi-font-style:normal;}
@list l7:level2
	{mso-level-style-link:"Heading 2";
	mso-level-text:"%1\.%2";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.5in;
	text-indent:-.5in;
	mso-ansi-font-size:11.0pt;
	mso-bidi-font-size:11.0pt;
	font-family:"Arial",sans-serif;
	mso-ansi-font-weight:normal;
	mso-ansi-font-style:normal;}
@list l7:level3
	{mso-level-text:"%1\.%2\.%3";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.0in;
	text-indent:-.5in;
	font-family:"Arial",sans-serif;}
@list l7:level4
	{mso-level-number-format:alpha-lower;
	mso-level-style-link:"Heading 4";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.5in;
	text-indent:-.5in;
	mso-ansi-font-size:12.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Times New Roman";
	letter-spacing:-.05pt;}
@list l7:level5
	{mso-level-style-link:"Heading 5";
	mso-level-text:"%1\.%2\.%3\.%4\.%5";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.7in;
	text-indent:-.7in;}
@list l7:level6
	{mso-level-style-link:"Heading 6";
	mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.8in;
	text-indent:-.8in;}
@list l7:level7
	{mso-level-style-link:"Heading 7";
	mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.9in;
	text-indent:-.9in;}
@list l7:level8
	{mso-level-style-link:"Heading 8";
	mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.0in;
	text-indent:-1.0in;}
@list l7:level9
	{mso-level-style-link:"Heading 9";
	mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.%9";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.1in;
	text-indent:-1.1in;}
@list l8
	{mso-list-id:1294942280;
	mso-list-type:hybrid;
	mso-list-template-ids:-2014667426 67698689 67698691 67698693 67698689 67698691 67698693 67698689 67698691 67698693;}
@list l8:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Symbol;}
@list l8:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:"Courier New";}
@list l8:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Wingdings;}
@list l8:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Symbol;}
@list l8:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:"Courier New";}
@list l8:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Wingdings;}
@list l8:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Symbol;}
@list l8:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:"Courier New";}
@list l8:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Wingdings;}
@list l9
	{mso-list-id:1387486190;
	mso-list-type:hybrid;
	mso-list-template-ids:2030460896 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l9:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l9:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l9:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l9:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l9:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l9:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l9:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l9:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l9:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l10
	{mso-list-id:1634670624;
	mso-list-type:hybrid;
	mso-list-template-ids:1301813308 67698689 67698691 67698693 67698689 67698691 67698693 67698689 67698691 67698693;}
@list l10:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Symbol;}
@list l10:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:"Courier New";}
@list l10:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Wingdings;}
@list l10:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Symbol;}
@list l10:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:"Courier New";}
@list l10:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Wingdings;}
@list l10:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Symbol;}
@list l10:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:"Courier New";}
@list l10:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Wingdings;}
@list l11
	{mso-list-id:1643658686;
	mso-list-type:hybrid;
	mso-list-template-ids:-1606393844 67698713 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l11:level1
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l11:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l11:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l11:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l11:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l11:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l11:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l11:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l11:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l12
	{mso-list-id:1749763229;
	mso-list-type:hybrid;
	mso-list-template-ids:484988468 134807553 67698691 67698693 67698689 67698691 67698693 67698689 67698691 67698693;}
@list l12:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Symbol;}
@list l12:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:"Courier New";}
@list l12:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Wingdings;}
@list l12:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Symbol;}
@list l12:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:"Courier New";}
@list l12:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Wingdings;}
@list l12:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Symbol;}
@list l12:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:"Courier New";}
@list l12:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Wingdings;}
@list l13
	{mso-list-id:1869029092;
	mso-list-type:hybrid;
	mso-list-template-ids:-1504033802 67698689 67698691 67698693 67698689 67698691 67698693 67698689 67698691 67698693;}
@list l13:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Symbol;}
@list l13:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:"Courier New";}
@list l13:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Wingdings;}
@list l13:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Symbol;}
@list l13:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:"Courier New";}
@list l13:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Wingdings;}
@list l13:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Symbol;}
@list l13:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:"Courier New";}
@list l13:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Wingdings;}
@list l14
	{mso-list-id:1912618987;
	mso-list-type:hybrid;
	mso-list-template-ids:-924024816 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l14:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l14:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l14:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l14:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l14:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l14:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l14:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l14:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l14:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l15
	{mso-list-id:1961569004;
	mso-list-type:hybrid;
	mso-list-template-ids:-1579261836 67698709 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l15:level1
	{mso-level-number-format:alpha-upper;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l15:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l15:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l15:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l15:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l15:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l15:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l15:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l15:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l16
	{mso-list-id:2137747370;
	mso-list-template-ids:1247941156;}
@list l16:level1
	{mso-level-start-at:4;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:27.0pt;
	text-indent:-27.0pt;}
@list l16:level2
	{mso-level-start-at:6;
	mso-level-text:"%1\.%2\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.5in;
	text-indent:-.5in;}
@list l16:level3
	{mso-level-text:"%1\.%2\.%3\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.5in;
	text-indent:-.5in;}
@list l16:level4
	{mso-level-text:"%1\.%2\.%3\.%4\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.75in;
	text-indent:-.75in;}
@list l16:level5
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.75in;
	text-indent:-.75in;}
@list l16:level6
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.0in;
	text-indent:-1.0in;}
@list l16:level7
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.0in;
	text-indent:-1.0in;}
@list l16:level8
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.25in;
	text-indent:-1.25in;}
@list l16:level9
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.%9\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.25in;
	text-indent:-1.25in;}
@list l7:level1 lfo18
	{mso-level-start-at:4;}
@list l7:level2 lfo18
	{mso-level-start-at:6;}
@list l7:level3 lfo18
	{mso-level-start-at:2;}
ol
	{margin-bottom:0in;}
ul
	{margin-bottom:0in;}
-->
</style>
<!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:"Table Normal";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-parent:"";
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-para-margin-top:0in;
	mso-para-margin-right:0in;
	mso-para-margin-bottom:10.0pt;
	mso-para-margin-left:0in;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:Mangal;
	mso-bidi-theme-font:minor-bidi;
	mso-ansi-language:EN-IN;}
table.MsoTableGrid
	{mso-style-name:"Table Grid";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:59;
	mso-style-unhide:no;
	border:solid windowtext 1.0pt;
	mso-border-alt:solid windowtext .5pt;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:.5pt solid windowtext;
	mso-border-insidev:.5pt solid windowtext;
	mso-para-margin:0in;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:Mangal;
	mso-bidi-theme-font:minor-bidi;
	mso-ansi-language:EN-IN;}
table.CHECTable1
	{mso-style-name:"CHEC Table 1";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:99;
	mso-style-unhide:no;
	border:solid #7F7F7F 1.0pt;
	mso-border-themecolor:text1;
	mso-border-themetint:128;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:1.0pt solid #7F7F7F;
	mso-border-insideh-themecolor:text1;
	mso-border-insideh-themetint:128;
	mso-border-insidev:1.0pt solid #7F7F7F;
	mso-border-insidev-themecolor:text1;
	mso-border-insidev-themetint:128;
	mso-para-margin-top:3.0pt;
	mso-para-margin-right:0in;
	mso-para-margin-bottom:3.0pt;
	mso-para-margin-left:0in;
	mso-pagination:widow-orphan;
	font-size:9.0pt;
	mso-bidi-font-size:11.0pt;
	font-family:"Arial",sans-serif;
	mso-bidi-font-family:Mangal;
	mso-bidi-theme-font:minor-bidi;
	mso-ansi-language:EN-AU;}
table.CHECTable1FirstRow
	{mso-style-name:"CHEC Table 1";
	mso-table-condition:first-row;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-ansi-font-weight:bold;}
table.CHECTable2
	{mso-style-name:"CHEC Table 2";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-parent:"CHEC Table 1";
	border:solid #7F7F7F 1.0pt;
	mso-border-themecolor:text1;
	mso-border-themetint:128;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:1.0pt solid #7F7F7F;
	mso-border-insideh-themecolor:text1;
	mso-border-insideh-themetint:128;
	mso-border-insidev:1.0pt solid #7F7F7F;
	mso-border-insidev-themecolor:text1;
	mso-border-insidev-themetint:128;
	mso-para-margin-top:3.0pt;
	mso-para-margin-right:0in;
	mso-para-margin-bottom:0in;
	mso-para-margin-left:0in;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:9.0pt;
	mso-bidi-font-size:11.0pt;
	font-family:"Arial",sans-serif;
	mso-bidi-font-family:Mangal;
	mso-bidi-theme-font:minor-bidi;
	mso-ansi-language:EN-AU;}
table.CHECTable2FirstRow
	{mso-style-name:"CHEC Table 2";
	mso-table-condition:first-row;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-parent:"CHEC Table 1";
	mso-tstyle-shading:#BFBFBF;
	mso-tstyle-shading-themecolor:background1;
	mso-tstyle-shading-themeshade:191;
	mso-tstyle-border-top:1.0pt solid #7F7F7F;
	mso-tstyle-border-top-themecolor:text1;
	mso-tstyle-border-top-themetint:128;
	mso-tstyle-border-left:1.0pt solid #7F7F7F;
	mso-tstyle-border-left-themecolor:text1;
	mso-tstyle-border-left-themetint:128;
	mso-tstyle-border-bottom:1.0pt solid #7F7F7F;
	mso-tstyle-border-bottom-themecolor:text1;
	mso-tstyle-border-bottom-themetint:128;
	mso-tstyle-border-right:1.0pt solid #7F7F7F;
	mso-tstyle-border-right-themecolor:text1;
	mso-tstyle-border-right-themetint:128;
	mso-tstyle-diagonal-down:cell-none;
	mso-tstyle-diagonal-up:cell-none;
	mso-tstyle-border-insideh:1.0pt solid #7F7F7F;
	mso-tstyle-border-insideh-themecolor:text1;
	mso-tstyle-border-insideh-themetint:128;
	mso-tstyle-border-insidev:1.0pt solid #7F7F7F;
	mso-tstyle-border-insidev-themecolor:text1;
	mso-tstyle-border-insidev-themetint:128;
	mso-ansi-font-weight:bold;}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="2049"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
</head>

<body lang=EN-US link=blue vlink=purple style="tab-interval:.5in">

<div class=WordSection1>

<p class=MsoNormalCxSpFirst style="text-align:justify"><b style="mso-bidi-font-weight:
normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial;text-transform:uppercase"><span style="mso-spacerun:yes"> </span><span
style="mso-spacerun:yes"> </span><o:p></o:p></span></b></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><b style="mso-bidi-font-weight:
normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial;text-transform:uppercase"><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center"><b
style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial;text-transform:uppercase">AGREEMENT
(“AGREEMENT”)<o:p></o:p></span></b></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center"><b
style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center"><b
style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial">DATED &lt;&lt;../../….&gt;&gt;<o:p></o:p></span></b></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center"><b
style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center"><b
style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial">BY AND BETWEEN<o:p></o:p></span></b></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center"><b
style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center"><b
style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial;color:red">NAME of Implementer of the
Project Selected<o:p></o:p></span></b></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">(“<b
style="mso-bidi-font-weight:normal">IMPLEMENTOR</b>”)<b style="mso-bidi-font-weight:
normal"><o:p></o:p></b></span></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center"><b
style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center"><b
style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial">AND<o:p></o:p></span></b></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center"><b
style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center"><b
style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial;color:red">Name of the Contributor<o:p></o:p></span></b></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center"><b
style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial">(“CONTRIBUTOR”)<o:p></o:p></span></b></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify;mso-pagination:none"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<span style="font-size:11.0pt;line-height:115%;font-family:DINPro-Regular;
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
mso-ansi-language:EN-US;mso-fareast-language:EN-US;mso-bidi-language:AR-SA"><br
clear=all style="mso-special-character:line-break;page-break-before:always">
</span>

<p class=MsoNormal style="margin-bottom:10.0pt;line-height:115%"><span
style="font-size:11.0pt;line-height:115%;font-family:DINPro-Regular;mso-bidi-font-family:
Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center;mso-pagination:
none"><b style="mso-bidi-font-weight:normal"><u><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">AGREEMENT<o:p></o:p></span></u></b></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify;mso-pagination:none"><b
style="mso-bidi-font-weight:normal"><u><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p><span
 style="text-decoration:none">&nbsp;</span></o:p></span></u></b></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify;mso-pagination:none"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">This
<b style="mso-bidi-font-weight:normal">Agreement<span style="text-transform:
uppercase"> </span></b>(“<b style="mso-bidi-font-weight:normal">Agreement</b>”)
is made as of the <span style="color:red">&lt;&lt;DATE&gt;&gt;</span><o:p></o:p></span></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center;mso-pagination:
none"><b style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">BY AND BETWEEN<o:p></o:p></span></b></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center;mso-pagination:
none"><b style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial;color:red">&lt;&lt;NAME
OF IMPLEMENTOR&gt;&gt;, </span><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">a <span style="color:red">&lt;&lt;TYPE OF
COMPANY&gt;&gt; </span>and having its office at <span style="color:red">&lt;&lt;IMPLEMENTOR
ADDDRESS&gt;&gt;</span> hereinafter referred to as the “<b style="mso-bidi-font-weight:
normal">Implementor</b>”, (which expression shall, unless excluded by or
repugnant to the subject or context, include its successors and permitted
assigns) <b style="mso-bidi-font-weight:normal">or</b> (which expression shall
unless it be repugnant to the context or meaning thereof be deemed to mean and
include the Trustees or Trustee for the time being of the said Trust) or of the
One Part; <o:p></o:p></span></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none"><b><u><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p><span
 style="text-decoration:none">&nbsp;</span></o:p></span></u></b></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center;mso-pagination:
none"><b style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">AND<o:p></o:p></span></b></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none"><b style="mso-bidi-font-weight:
normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial"><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial;color:red">&lt;&lt;NAME
OF CONTRIBUTOR&gt;&gt;, </span><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">a <span style="color:red">&lt;&lt;TYPE OF
COMPANY&gt;&gt; </span><span style="mso-spacerun:yes"> </span>and having its
office at <span style="color:red"><span style="mso-spacerun:yes"> </span>&lt;&lt;CONTRIBUTOR
ADDRESS&gt;&gt;</span>, hereinafter referred to as the “<b style="mso-bidi-font-weight:
normal">Contributor</b>” (which expression shall, unless excluded by or be
repugnant to the subject or context, include its successors and assigns) of the
Other Part. <o:p></o:p></span></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify;mso-pagination:none"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">The
Implementor and the Contributor shall individually be referred to as the “<b
style="mso-bidi-font-weight:normal">Party</b>” and collectively as the “<b
style="mso-bidi-font-weight:normal">Parties</b>”.<o:p></o:p></span></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify;mso-pagination:none"><b
style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormalCxSpLast style="text-align:justify;mso-pagination:none"><b
style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial">WHEREAS</span></b><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">;<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpFirst style="text-align:justify;mso-pagination:
none"><span style="font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.5in;
mso-pagination:none;mso-list:l5 level1 lfo2"><![if !supportLists]><span
style="font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;
mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">A.<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">The Implementor herein has an established track
record in undertaking similar projects/programs as contemplated herein and has
successfully made a positive contribution to the society through high impact social
welfare initiatives.<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;mso-pagination:
none"><span style="font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.5in;
mso-pagination:none;mso-list:l5 level1 lfo2"><![if !supportLists]><b
style="mso-bidi-font-weight:normal"><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">B.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span></b><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">The Implementor has registered itself on truCSR Portal
(“<b>Portal</b>”) owned and managed by Green Scarf Management Consultants Private
Limited (“<b>GSMC</b>”) wherein it has uploaded and made available all details
and information in respect of certain Project(s) / Program(s), budget and the
implementation plan in respect thereof (“<b style="mso-bidi-font-weight:normal">Project/Program</b>”)
with an objective to promote and raise funds for the same. <b style="mso-bidi-font-weight:
normal"><o:p></o:p></b></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;mso-pagination:
none"><span style="font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.5in;
mso-pagination:none;mso-list:l5 level1 lfo2"><![if !supportLists]><span
style="font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;
mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">C.<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">The Contributor being desirous of undertaking its Corporate
Social Responsibility under the provisions of Companies Act, 2013 and the rules
and regulations framed thereunder,, has also registered itself on the <span
style="mso-bidi-font-weight:bold">said Portal. For the said purposes, </span>the
Contributor’s CSR Committee (“<b style="mso-bidi-font-weight:normal">said CSR
Committee</b>”) has perused the Selected Project/Program alongwith its
implementation plan and budget made available by the Implementor and all other
information and details sought from the Implementor and has selected the same in
pursuance of its CSR Philosophy and Policy, details whereof along with its
budget and implementation plan [“Selected Project(s) / Program(s)]” are more
particularly set out in <b>Schedule I</b> appended here under.<o:p></o:p></span></p>

<p class=MsoListParagraph><span style="font-family:DINPro-Regular;mso-bidi-font-family:
Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.5in;
mso-pagination:none;mso-list:l5 level1 lfo2"><![if !supportLists]><span
style="font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;
mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">D.<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">The Contributor vide its Board Resolution dated <span
style="color:red">&lt;&lt;RESOLUTION DATE&gt;&gt;</span> has agreed to
contribute a sum of Rs.<span style="color:red">&lt;&lt;CONTRIBUTION AMOUNT&gt;&gt;/-
</span>(Rupees <span style="color:red">&lt;&lt;AMOUNT IN WORDS&gt;&gt; </span>only)
to the Implementor. The Board Resolution dated<span style="color:red"> &lt;&lt;RESOLUTION
DATE&gt;&gt; </span>inter alia approving the grant of the aforesaid
contribution and Agreement for the Selected Project/ Program is hereto annexed
and marked as <b><u>Annexure - #01. </u></b><o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;mso-pagination:
none"><span style="font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.5in;
mso-pagination:none;mso-list:l5 level1 lfo2"><![if !supportLists]><span
style="font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;
mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">E.<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">The Parties have agreed to enter into these
presents on the terms and conditions as set out hereinafter.<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpLast style="text-align:justify;mso-pagination:
none"><span style="font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style="text-align:justify;mso-pagination:none"><b
style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial">NOW THIS AGREEMENT WITNESSETH AND IT
IS HEREBY AGREED BY AND BETWEEN THE PARTIES HERETO AS FOLLOWS </span></b><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p></o:p></span></p>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:none"><a
name="_Toc227644774"><span style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></a></h1>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><span
style="mso-bookmark:_Toc227644774"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;
mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">1<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><u><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Definitions</span></u></span><span
style="mso-bookmark:_Toc227644774"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">:- <o:p></o:p></span></span></h1>

<h1 style="text-indent:0in;mso-pagination:none;page-break-after:auto;
mso-list:none"><span style="mso-bookmark:_Toc227644774"><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></h1>

<p class=MsoListParagraphCxSpFirst style="margin-left:1.0in;mso-add-space:auto;
text-align:justify;text-indent:-.5in;mso-list:l6 level1 lfo13"><span
style="mso-bookmark:_Toc227644774"><![if !supportLists]><span style="font-family:
DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">(a)<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">“<b style="mso-bidi-font-weight:normal">Act</b>”
shall mean and include all the provisions of the Companies Act, 2013 and rules
and regulations framed thereunder and that shall be framed from time to time
under the Companies Act, 2013 and any amendments thereto.<o:p></o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify"><span style="mso-bookmark:_Toc227644774"><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify;text-indent:-.5in;mso-list:l6 level1 lfo13"><span
style="mso-bookmark:_Toc227644774"><![if !supportLists]><span style="font-family:
DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">(b)<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><b style="mso-bidi-font-weight:normal"><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial">“Applicable Law” </span></b></span><span
style="mso-bookmark:_Toc227644774"><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">means any and all applicable provisions of any (a)
constitution, treaties, statutes, laws (including the common law), codes,
rules, regulations, ordinances or orders of any Governmental Authority, and (b)
Governmental Approvals, and (c) orders, decisions, injunctions, judgments,
awards and decrees of or agreements with any Governmental Authority and <b
style="mso-bidi-font-weight:normal">“Applicable Laws” </b>shall be construed
accordingly<o:p></o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify"><span style="mso-bookmark:_Toc227644774"><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify;text-indent:-.5in;mso-list:l6 level1 lfo13"><span
style="mso-bookmark:_Toc227644774"><![if !supportLists]><span style="font-family:
DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">(c)<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular">&quot;<b
style="mso-bidi-font-weight:normal">Confidential Information</b>&quot; shall
mean and include any information which relates to the financial and/or business
operations of the Contributor, including but not limited to, specifications,
drawings, sketches, models, samples, reports, forecasts, current or historical
data, computer programs or documentation and all other technical, financial or
business data, including, but not limited to, information related to the
Contributor’s shareholders, directors, employees, customers, products,
processes, financial condition, intellectual property, manufacturing
techniques, experimental work, trade secrets etc. All such Confidential
Information is and shall remain the exclusive property of the Contributor and
the Implementor will not acquire any rights to that confidential information.</span></span><span
style="mso-bookmark:_Toc227644774"><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial"><o:p></o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify"><span style="mso-bookmark:_Toc227644774"><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<p class=MsoListParagraphCxSpLast style="margin-left:1.0in;mso-add-space:auto;
text-align:justify;text-indent:-.5in;mso-list:l6 level1 lfo13"><span
style="mso-bookmark:_Toc227644774"><![if !supportLists]><span style="font-family:
DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">(d)<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">“<b style="mso-bidi-font-weight:normal">Contribution
Amount</b>” shall mean an amount of a sum up to Rs. .<span style="color:red">&lt;&lt;CONTRIBUTION
AMOUNT&gt;&gt;</span><span style="mso-spacerun:yes">  </span>which the
Contributor has agreed to provide to the Implementor for the implementation of
the desirous Project/Program.<o:p></o:p></span></span></p>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc227644774"><span
style="font-family:DINPro-Regular;mso-fareast-font-family:Calibri;mso-bidi-font-family:
Arial"><o:p>&nbsp;</o:p></span></span></p>

<p class=MsoListParagraphCxSpFirst style="margin-left:1.0in;mso-add-space:auto;
text-align:justify;text-indent:-.5in;mso-list:l6 level1 lfo13"><span
style="mso-bookmark:_Toc227644774"><![if !supportLists]><span style="font-family:
DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">(e)<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
mso-bidi-font-weight:bold">“<b>CSR Activities</b>” shall include and mean all activities
as set out under Schedule VII of the Companies Act, 2013.</span></span><span
style="mso-bookmark:_Toc227644774"><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial"><o:p></o:p></span></span></p>

<p class=MsoListParagraph><span style="mso-bookmark:_Toc227644774"><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify;text-indent:-.5in;mso-list:l6 level1 lfo13"><span
style="mso-bookmark:_Toc227644774"><![if !supportLists]><span style="font-family:
DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular;mso-bidi-font-weight:bold"><span style="mso-list:Ignore">(f)<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular">&quot;</span></span><span
style="mso-bookmark:_Toc227644774"><b><span style="font-family:DINPro-Regular;
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial">CSR
Committee</span></b></span><span style="mso-bookmark:_Toc227644774"><span
style="font-family:DINPro-Regular">&quot; </span></span><span style="mso-bookmark:
_Toc227644774"><span style="font-family:DINPro-Regular;mso-fareast-font-family:
"Times New Roman";mso-bidi-font-family:Arial;mso-bidi-font-weight:bold">means
the Corporate Social Responsibility Committee of the Board referred to in
Section 135 of the Companies Act, 2013.<o:p></o:p></span></span></p>

<p class=MsoListParagraph><span style="mso-bookmark:_Toc227644774"><span
style="font-family:DINPro-Regular;mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:Arial;mso-bidi-font-weight:bold"><o:p>&nbsp;</o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify;text-indent:-.5in;mso-list:l6 level1 lfo13"><span
style="mso-bookmark:_Toc227644774"><![if !supportLists]><span style="font-family:
DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular;mso-bidi-font-weight:bold"><span style="mso-list:Ignore">(g)<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular">&quot;</span></span><span
style="mso-bookmark:_Toc227644774"><b><span style="font-family:DINPro-Regular;
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial">CSR
Policy</span></b></span><span style="mso-bookmark:_Toc227644774"><span
style="font-family:DINPro-Regular">&quot; </span></span><span style="mso-bookmark:
_Toc227644774"><span style="font-family:DINPro-Regular;mso-fareast-font-family:
"Times New Roman";mso-bidi-font-family:Arial;mso-bidi-font-weight:bold">relates
to the activities to be undertaken by the company as specified in Schedule VII
to the Act and the expenditure thereon, excluding activities undertaken in
pursuance of normal course of business of a Company.<o:p></o:p></span></span></p>

<p class=MsoListParagraph><span style="mso-bookmark:_Toc227644774"><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify;text-indent:-.5in;mso-list:l6 level1 lfo13"><span
style="mso-bookmark:_Toc227644774"><![if !supportLists]><span style="font-family:
DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">(h)<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">“<b style="mso-bidi-font-weight:normal">GSMC</b>” </span></span><span
style="mso-bookmark:_Toc227644774"><span style="font-family:DINPro-Regular;
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
mso-bidi-font-weight:bold">shall mean Green Scarf Management Consultants
Private Limited, being a private limited company incorporated under the
Companies Act, 2013 having Corporate Identification Number (CIN)
U74999MH2019PTC329820 and its registered address at 46, Bajaj Bhavan 4th Floor
Jamnalal Bajaj Marg, 226 Nariman Point Mumbai Mumbai-400021. </span></span><span
style="mso-bookmark:_Toc227644774"><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial"><o:p></o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify"><span style="mso-bookmark:_Toc227644774"><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify;text-indent:-.5in;mso-list:l6 level1 lfo13"><span
style="mso-bookmark:_Toc227644774"><![if !supportLists]><span style="font-family:
DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">(i)<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">“<b>Project Documents</b>” shall mean all the
manuals, records, registers, consents, approvals, permissions and all other
documents maintained by the Implementor exclusively in relation to the implementation
and progress of the </span></span><span style="mso-bookmark:_Toc227644774"><span
style="font-family:DINPro-Regular">Selected </span></span><span
style="mso-bookmark:_Toc227644774"><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Project/Program.<o:p></o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify"><span style="mso-bookmark:_Toc227644774"><span
style="font-size:9.0pt;mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify;text-indent:-.5in;mso-list:l6 level1 lfo13"><span
style="mso-bookmark:_Toc227644774"><![if !supportLists]><span style="font-family:
DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">(j)<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">“<b>Project Monitoring Report</b>” shall mean the
report containing the progress, status and amount spent towards the
implementation of the Selected Project/Program based on various parameters and in
accordance with the terms of this Agreement.<o:p></o:p></span></span></p>

<p class=MsoListParagraph><span style="mso-bookmark:_Toc227644774"><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify;text-indent:-.5in;mso-list:l6 level1 lfo13"><span
style="mso-bookmark:_Toc227644774"><![if !supportLists]><span style="font-family:
DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">(k)<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">“<b style="mso-bidi-font-weight:normal">said</b> <b
style="mso-bidi-font-weight:normal">Portal</b>” shall mean and include the
electronic platform viz. </span></span><a href="http://www.trucsr.com"><span
style="mso-bookmark:_Toc227644774"><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial;color:windowtext">www.trucsr.com</span></span></a><span
style="mso-bookmark:_Toc227644774"><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial"> owned and managed by GSMC and all its
applications, software and content available thereon. <o:p></o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify"><span style="mso-bookmark:_Toc227644774"><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify;text-indent:-.5in;mso-list:l6 level1 lfo13"><span
style="mso-bookmark:_Toc227644774"><![if !supportLists]><span style="font-family:
DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">(l)<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">“<b>Project/Program</b>” shall mean the proposal(s)
uploaded on the said Portal by the Implementor for procuring the Contribution Amount
required for implementing the Project/Program, mentioning inter alia the
project cost, implementation schedule, target beneficiaries from the Project/Program
etc.;<o:p></o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify;text-indent:-.5in"><span style="mso-bookmark:_Toc227644774"><span
style="font-size:7.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify;text-indent:-.5in;mso-list:l6 level1 lfo13"><span
style="mso-bookmark:_Toc227644774"><![if !supportLists]><span style="font-family:
DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">(m)<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">“<b>Schedule(s)</b>” means the Schedule(s) to this Agreement
and which forms an integral part of this Agreement.<o:p></o:p></span></span></p>

<p class=MsoListParagraph><span style="mso-bookmark:_Toc227644774"><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify;text-indent:-.5in;mso-list:l6 level1 lfo13"><span
style="mso-bookmark:_Toc227644774"><![if !supportLists]><span style="font-family:
DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">(n)<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><b><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Selected Project/Program</span></b></span><span
style="mso-bookmark:_Toc227644774"><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">” shall mean the proposal as selected by the
Contributor out of the Projects/ Programs uploaded on the said Portal by the Implementor
for procuring the Contribution Amount required for implementing the </span></span><span
style="mso-bookmark:_Toc227644774"><span style="font-family:DINPro-Regular">Selected
</span></span><span style="mso-bookmark:_Toc227644774"><span style="font-family:
DINPro-Regular;mso-bidi-font-family:Arial">Project/Program, mentioning inter
alia the project cost, implementation schedule, target beneficiaries from the
Project/Program etc. the copy of the same is annexed herewith as <span
style="mso-bidi-font-weight:bold;mso-bidi-font-style:italic">Schedule I</span>;<o:p></o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify;text-indent:-.5in"><span style="mso-bookmark:_Toc227644774"><span
style="font-size:8.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<p class=MsoListParagraphCxSpLast style="margin-left:1.0in;mso-add-space:auto;
text-align:justify;text-indent:-.5in;mso-list:l6 level1 lfo13"><span
style="mso-bookmark:_Toc227644774"><![if !supportLists]><span style="font-family:
DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">(o)<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">“<b>Taxes</b>” shall mean and include all present
and future taxes, levies, imposts, duties or charges of a similar nature
whatsoever imposed or exempted by any Authority.<o:p></o:p></span></span></p>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc227644774"><span
style="font-size:8.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<span style="mso-bookmark:_Toc227644774"></span>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><a
name="_Toc468732399"><![if !supportLists]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><u><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Representations and
Warranties:-<o:p></o:p></span></u></a></h1>

<p class=MsoNormal><span style="mso-bookmark:_Toc468732399"><span
style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc468732399"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">2.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><b><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">By the Contributor:- <o:p></o:p></span></b></span></h2>

<p class=MsoNormal><span style="mso-bookmark:_Toc468732399"><span
style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc468732399"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">2.1.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">That the Contributor is entitled to enter into this
Agreement and that the information/disclosure made available by it on the said
Portal and any prior or subsequent information or explanation furnished by the
Contributor is true, bona fide and accurate in all material respects.<o:p></o:p></span></span></h2>

<p class=MsoNormal><span style="mso-bookmark:_Toc468732399"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc468732399"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">2.1.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">That the Contributor has in compliance with the
provisions of the Act validly constituted the CSR Committee and passed the
Board Resolution dated <span style="color:red">&lt;&lt;RESOLUTION DATE&gt;&gt; </span>under
which the Contributor had agreed to contribute the Contribution Amount to the Implementor
towards the Selected<span style="mso-spacerun:yes">  </span>Project / Program.<o:p></o:p></span></span></h2>

<p class=MsoNormal><span style="mso-bookmark:_Toc468732399"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc468732399"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">2.1.3<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">That the Contributor is financially sound to
undertake its Corporate Social Responsibility as per the provisions of the Act and
is neither insolvent nor any insolvency proceedings are initiated against it
till date.<o:p></o:p></span></span></h2>

<p class=MsoNormal><span style="mso-bookmark:_Toc468732399"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc468732399"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">2.1.4<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">That the Contributor undertakes to comply with the
terms of this Agreement.<o:p></o:p></span></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc468732399"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc468732399"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">2.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><b><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">By the Implementor:-<span
style="mso-spacerun:yes">  </span><o:p></o:p></span></b></span></h2>

<p class=MsoNormal><span style="mso-bookmark:_Toc468732399"><span
style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc468732399"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">2.2.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor represents that it is duly
incorporated and validly existing under the Laws of India and is in compliance
of all Applicable Laws and possesses all statutory approvals and compliances
for the execution of this Agreement and for implementation of the Selected Project/Program.
<o:p></o:p></span></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;text-indent:0in;mso-list:none"><span
style="mso-bookmark:_Toc468732399"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc468732399"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">2.2.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor represents that there are no Project/Program
(s) and/or any matters in relation thereto where any actions, suits or
proceedings whether civil or criminal in nature pending or threatened against
it save and except those disclosed by the Implementor on the said Portal. <o:p></o:p></span></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;text-indent:0in;mso-list:none"><span
style="mso-bookmark:_Toc468732399"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc468732399"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">2.2.3<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor represents that it has not/is not
engaged in any activities which are of moral turpitude, illegal in nature and
in breach of any of the Applicable Law, rules and regulations.<o:p></o:p></span></span></h2>

<p class=MsoNormal><span style="mso-bookmark:_Toc468732399"><span
style="font-size:8.0pt;mso-bidi-font-size:12.0pt;font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc468732399"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">2.2.4<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor represents that it has the
necessary infrastructure, experience and assistance of high reputes alongwith
appropriate content, technical inputs, skilled personnel and instruments
required </span></span><span style="mso-bookmark:_Toc468732399"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-language:
HI">for implementation of the </span></span><span style="mso-bookmark:_Toc468732399"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular">Selected </span></span><span
style="mso-bookmark:_Toc468732399"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-language:HI">Project/Program;</span></span><span
style="mso-bookmark:_Toc468732399"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"> <o:p></o:p></span></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc468732399"><span
style="font-size:8.0pt;mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc468732399"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">2.2.5<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor represents that all the information
posted and that which will be posted from time to time on the said Portal by
the Implementor is/ shall be complete, true, accurate and not misleading and that
the description, details and the respective images as uploaded of the Selected Project/Program
are not deceptive and that any prior or subsequent information or explanation
furnished by the Implementor to the Contributor is/ shall be true, bona fide
and accurate in all material respects. <o:p></o:p></span></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;text-indent:0in;mso-list:none"><span
style="mso-bookmark:_Toc468732399"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><span style="mso-spacerun:yes"> </span></span></span><span
style="mso-bookmark:_Toc468732399"><span style="font-size:7.0pt;mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular"><o:p></o:p></span></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc468732399"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial;mso-bidi-language:
HI"><span style="mso-list:Ignore">2.2.6<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-language:HI">That the Implementor represents
that it has at all times abided by stipulations, covenants terms and conditions
stipulated in any of its prior or existing agreements / agreement’s /
arrangements and/or any other documents including but not limited to any
undertakings and affidavits executed by it and has till date neither violated
nor received any notice for violation of the aforesaid documents which will
prejudice the </span></span><span style="mso-bookmark:_Toc468732399"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular">Selected </span></span><span
style="mso-bookmark:_Toc468732399"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-language:HI">Project/Program in any manner
whatsoever and/or prevents it from entering into this Agreement; <o:p></o:p></span></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;text-indent:0in;mso-list:none"><span
style="mso-bookmark:_Toc468732399"><span style="font-size:8.0pt;mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-language:HI"><o:p>&nbsp;</o:p></span></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc468732399"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial;mso-bidi-language:
HI"><span style="mso-list:Ignore">2.2.7<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-language:HI">The Implementor represents
that save and except the financial support for the Selected Project/ Program as
disclosed by the Implementor on the said Portal the Implementor has not taken
any financial support for the Selected Project/ Program from the Contributor
during the financial year in which proposal is being submitted; <span
style="mso-spacerun:yes"> </span><o:p></o:p></span></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc468732399"><span
style="font-size:8.0pt;mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial;mso-bidi-language:HI"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc468732399"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial;mso-bidi-language:
HI"><span style="mso-list:Ignore">2.2.8<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-language:HI">The Implementor represents
that </span></span><span style="mso-bookmark:_Toc468732399"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular">there is no
employee and employer or principal and agent relationship between </span></span><span
style="mso-bookmark:_Toc468732399"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-language:HI">the Implementor and the
Contributor nor they are in any manner related/affiliated to one another;<span
style="mso-spacerun:yes">   </span><o:p></o:p></span></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc468732399"><span
style="font-size:8.0pt;mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc468732399"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">2.2.9<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor represents that it shall not make
any variations in the Selected Project/Program alongwith its implementation
plan detailed in Schedule II, unless mutually agreed in writing.<o:p></o:p></span></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc468732399"><span
style="font-size:9.0pt;mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<span style="mso-bookmark:_Toc468732399"></span>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">3<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><u><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Contribution Agreement:-<o:p></o:p></span></u></h1>

<p class=MsoNormal><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">3.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Contributor relying on the representations and
warranties as furnished by the Implementor has agreed to contribute the
Contribution Amount amounting to a sum of Rs. <span style="color:red">&lt;&lt;CONTRIBUTION
AMOUNT&gt;&gt; </span>in aggregate (“<b>Contribution Amount</b>”) </span><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-language:
HI">for the Selected Project/ Program</span><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular"> in the mode and manner as set out in <b>Schedule
II</b> appended hereunder and consequently the Implementor agrees and undertakes
to use the Contribution Amount for the Selected Project/Program strictly in
accordance with the terms and conditions hereunder. <o:p></o:p></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">4<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><u><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Pre-Disbursement Requirements:-</span></u><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial"><o:p></o:p></span></h1>

<p class=MsoNormal style="margin-top:0in;margin-right:10.0pt;margin-bottom:
0in;margin-left:14.0pt;margin-bottom:.0001pt;text-align:justify"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><span
style="mso-spacerun:yes"> </span><o:p></o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">4.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor shall comply with the following
conditions prior to each disbursement of the Contribution Amount:<o:p></o:p></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h2 style="margin-left:1.0in;mso-list:l7 level3 lfo1"><![if !supportLists]><span
style="font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">4.1.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular">Submission
of certified copy of the board resolution of the Board of Directors/ Board of
Trustees of Implementor inter alia for the appointment of its authorized
representative thereby authorizing such representative(s) to act on its behalf;<o:p></o:p></span></h2>

<h2 style="margin-left:1.0in;text-indent:0in;mso-list:none"><span
style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h2 style="margin-left:1.0in;mso-list:l7 level3 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">4.1.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Submission of an undertaking from that it shall
submit the Project Report(s), Audit Report(s), self certified documents
obtained by the independent entities in respect of the Selected Project/Program
and all other relevant documents as recorded under this Agreement.<o:p></o:p></span></h2>

<h2 style="margin-left:1.0in;text-indent:0in;mso-list:none"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h2 style="margin-left:1.0in;mso-list:l7 level3 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">4.1.3<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Submission of a declaration-cum-undertaking by the Implementor
that no fees or any other charges whatsoever on any account shall be levied on
the beneficiaries under the Selected Project/Program.<o:p></o:p></span></h2>

<h2 style="margin-left:1.0in;text-indent:0in;mso-list:none"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h2 style="margin-left:1.0in;mso-list:l7 level3 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">4.1.4<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Any other requirements as may be prescribed by the Contributor
on a case to case basis.<o:p></o:p></span></h2>

<h2 style="margin-left:1.0in;text-indent:0in;mso-list:none"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">4.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor shall comply with the following
project specific pre-disbursement conditions prior to each disbursement of the
Grant Amount:<o:p></o:p></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<h2 style="margin-left:1.0in;mso-list:l7 level3 lfo1"><![if !supportLists]><span
style="font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">4.2.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular">Specific
pre-</span><span style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular">disbursement</span><span
style="font-family:DINPro-Regular"> conditions to be complied with by the Implementor
prior to disbursement of the first installment or one-time payment as the case
maybe:<o:p></o:p></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style="margin-left:68.0pt;text-align:justify;text-indent:
-35.6pt;mso-list:l0 level3 lfo14;tab-stops:68.0pt"><![if !supportLists]><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore"><span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">(i) Execution of this Agreement between the
Contributor and the Implementor.<o:p></o:p></span></p>

<p class=MsoNormal style="text-align:justify"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoListParagraph style="margin-top:0in;margin-right:11.0pt;margin-bottom:
0in;margin-left:1.0in;margin-bottom:.0001pt;text-align:justify;text-indent:
-.5in;mso-list:l7 level3 lfo18;tab-stops:32.0pt"><![if !supportLists]><span
style="font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">4.2.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Specific pre-disbursement conditions to be complied
with by the Implementor prior to disbursement of the subsequent tranches after
the First installment or the one-time payment as the case maybe, which shall
be:<o:p></o:p></span></p>

<p class=MsoListParagraph style="margin-top:0in;margin-right:11.0pt;margin-bottom:
0in;margin-left:1.0in;margin-bottom:.0001pt;text-align:justify;tab-stops:32.0pt"><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style="margin-top:0in;margin-right:10.0pt;margin-bottom:
0in;margin-left:68.0pt;margin-bottom:.0001pt;text-align:justify;text-indent:
-35.7pt;mso-list:l1 level3 lfo15;tab-stops:68.0pt"><![if !supportLists]><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore"><span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">(i) Submission of duly certified utilization
certificates by an tilizati chartered accountant, thereby certifying tilization
of the funds for that stage as prescribed in Schedule II hereunder from the
total Contribution Amount towards the </span><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular">Selected </span><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Project/Program, by the Implementor;<o:p></o:p></span></p>

<p class=MsoNormal style="margin-right:10.0pt;text-align:justify;tab-stops:
68.0pt"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style="margin-top:0in;margin-right:10.0pt;margin-bottom:
0in;margin-left:68.0pt;margin-bottom:.0001pt;text-align:justify;text-indent:
-35.7pt;mso-list:l2 level3 lfo16;tab-stops:68.0pt"><a name=page12></a><![if !supportLists]><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore"><span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">(ii) Submission of audit reports of the funds
disbursed by the Contributing Partner thereby demonstrating that the said funds
have been duly utilized towards the </span><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular">Selected </span><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Project/Program;<o:p></o:p></span></p>

<p class=MsoNormal style="margin-top:0in;margin-right:10.0pt;margin-bottom:
0in;margin-left:68.0pt;margin-bottom:.0001pt;text-align:justify;tab-stops:68.0pt"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style="margin-top:0in;margin-right:10.0pt;margin-bottom:
0in;margin-left:68.0pt;margin-bottom:.0001pt;text-align:justify;text-indent:
-35.7pt;mso-list:l2 level3 lfo16;tab-stops:68.0pt"><![if !supportLists]><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore"><span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">(iii) Submission of Progress Reports to the
Contributor on a regular basis in the prescribed format for the approved
expenditure;<o:p></o:p></span></p>

<p class=MsoNormal style="margin-top:0in;margin-right:10.0pt;margin-bottom:
0in;margin-left:68.0pt;margin-bottom:.0001pt;text-align:justify;tab-stops:68.0pt"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style="margin-top:0in;margin-right:10.0pt;margin-bottom:
0in;margin-left:68.0pt;margin-bottom:.0001pt;text-align:justify;text-indent:
-35.7pt;mso-list:l2 level3 lfo16;tab-stops:68.0pt"><![if !supportLists]><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore"><span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">(iv) Furnishing of a Declaration-cum-certificate by
the Implementor thereby declaring and certifying that </span><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular">Selected </span><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Project/Program
is being implemented as per the </span><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Selected </span><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Project Proposal as
approved by the Contributor;<o:p></o:p></span></p>

<p class=MsoNormal style="margin-top:0in;margin-right:10.0pt;margin-bottom:
0in;margin-left:68.0pt;margin-bottom:.0001pt;text-align:justify;tab-stops:68.0pt"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style="margin-top:0in;margin-right:10.0pt;margin-bottom:
0in;margin-left:68.0pt;margin-bottom:.0001pt;text-align:justify;text-indent:
-35.7pt;mso-list:l2 level3 lfo16;tab-stops:68.0pt"><![if !supportLists]><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore"><span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">(v) Furnishing of an undertaking from the Implementor
thereby undertaking that the Contributor shall have the discretion to conduct
checks and audits in respect of the </span><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular">Selected </span><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Project/Program.<o:p></o:p></span></p>

<p class=MsoNormal style="margin-top:0in;margin-right:10.0pt;margin-bottom:
0in;margin-left:68.0pt;margin-bottom:.0001pt;text-align:justify;tab-stops:68.0pt"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style="margin-left:68.0pt;text-align:justify;text-indent:
-35.6pt;mso-list:l2 level3 lfo16;tab-stops:68.0pt"><![if !supportLists]><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore"><span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">(vi) Any other clause as may be prescribed on a
case to case basis<o:p></o:p></span></p>

<p class=MsoNormal style="margin-left:68.0pt;text-align:justify;tab-stops:68.0pt"><i><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></i></p>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">5<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><u><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Mode and Manner of
Contribution:- <span style="mso-spacerun:yes"> </span><o:p></o:p></span></u></h1>

<p class=MsoNormal><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">5.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">It is agreed between the Parties that the
Contribution Amount shall be disbursed by the Contributor in installments
linked to the stage wise manner of the implementation of the Selected Project/Program
as set out more particularly in Schedule II appended hereunder<o:p></o:p></span></h2>

<p class=MsoNormal style="text-indent:.5in"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial;mso-bidi-font-weight:
bold"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style="text-indent:.5in"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial;mso-bidi-font-weight:
bold">OR<o:p></o:p></span></p>

<p class=MsoNormal style="text-indent:.5in"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial;mso-bidi-font-weight:
bold"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style="margin-left:.5in"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial;mso-bidi-font-weight:
bold">Simultaneously on the execution of this Agreement, the Contribution
Amount shall be disbursed by the Contributor to the Implementor as one-time
payment.<o:p></o:p></span></p>

<h2 style="text-indent:0in;mso-list:none"><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">5.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">It is expressly clarified that by the Implementor,
that the Contribution Amount</span><span style="font-family:DINPro-Regular"><o:p></o:p></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;text-indent:0in;mso-list:none"><span
style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">5.2.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">shall be disbursed by the Contributor as per the
Schedule II only; and<o:p></o:p></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;text-indent:0in;mso-list:none"><span
style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><![if !supportLists]><span
style="font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">5.2.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">shall be utilized by the Implementor solely for the
implementation of the Selected Project/Program and shall not be used for any
other purpose including the payment of any outstanding loan or debt due to any
other person.</span><span style="font-family:DINPro-Regular"><o:p></o:p></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">5.3<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Parties agree and confirm that the payment of
the Contribution Amount shall be made by the Contributor through the payment
system generated on the said Portal under which the Contribution Amount shall
be disbursed by the Contributor into a separate / designated bank nodal account
and upon verification of the details thereof and the Contribution Amount shall
be credited into the account <span style="mso-spacerun:yes"> </span>of the Implementor
as may be specified for the purposes of the Selected Project / Program.<o:p></o:p></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">5.4<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Parties agree and confirm that in the event of
any shortcoming on part of the Implementor to perform/implement the Selected Project/
Program or its inability to not perform as per the scope of work and targets
set out in Schedule II and/or there is non-performance or breach of any of the
terms and conditions of this Agreement, the Contributor shall have a right to
revise and/or reduce and/or withhold the Contribution Amount or any part
thereof and/or to terminate this Agreement as set out in Clause __ hereinabove
at its sole discretion. <o:p></o:p></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">5.5<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Parties agree that in the event the
Contribution Amount is revised and/or reduced and/or withheld as stated herein
above, then the release of the remaining Contribution Amount shall be made
solely upon the discretion of the Contributor and only upon remedying of the
unsatisfactory work and on resolution of the all outstanding queries by the Implementor
to the satisfaction of the Contributor.<o:p></o:p></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">5.6<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">In the event, the Implementor is desirous of making
any variations in the implementation plan as set out in Schedule II the same
shall be agreed upon by both the Parties in writing, and in such an event it is
expressly agreed that all the others terms and conditions of this Agreement shall
remain subsisting and binding on both the Parties and the same shall be
modified only to the limited extent of the amended Schedule II. <o:p></o:p></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">5.7<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">In the event, the cumulative disbursements made to
the Selected Project/Program are in excess of the expenditure actually incurred
for the Selected Project/Program as per <span style="mso-spacerun:yes"> </span>the
implementation plan under Schedule II and/or the cumulative disbursements made
are not utilized for a period of more than 3 (Three) months by the, Implementor,
then the Contributor shall be entitled to either (1) continue with the Implementor
utilizing the excess contribution and/or (2) deduct the excess expenses from
future installments to be disbursed to the Implementor, if any and/or (3)
utilize<span style="mso-spacerun:yes">  </span>the excess amount towards any
other mutually acceptable project/ program.. <o:p></o:p></span></h2>

<h2 style="text-indent:0in;mso-list:none"><b><u><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular"><o:p><span style="text-decoration:none">&nbsp;</span></o:p></span></u></b></h2>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">5.8<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Parties hereby expressly agree and confirm that
in the event the Contributor is contributing more than 100% (one hundred per
cent) of the Contribution as envisaged by the Implementor for the Selected
Project / Program, then during the term of this Agreement the Implementor shall,
only after obtaining the prior written consent of the Contributor be at liberty
to apply and/or obtain further contributions and/or any loan from any third
party in respect of the Selected Project /Program. <b><u><o:p></o:p></u></b></span></h2>

<h2 style="text-indent:0in;mso-list:none"><b><u><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular"><o:p><span style="text-decoration:none">&nbsp;</span></o:p></span></u></b></h2>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><a
name="_Toc468732401"><![if !supportLists]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">6<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><u><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Project Monitoring and </span></u></a><u><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">Reporting</span></u><span style="mso-bidi-font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial">: -<o:p></o:p></span></h1>

<p class=MsoNormal><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">6.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor shall at all times monitor the
implementation of the Selected Project/Program and ensures its smooth
implementation. The Implementor shall at its sole responsibility ensure that no
adverse impact is created on the Selected Project/Project and shall not be
entitled to outsource the monitoring and the implementation of the Selected Project/Program.<o:p></o:p></span></h2>

<p class=MsoNormal><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">6.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor agreed and confirms to post regular
updates, photographs and information on the said Portal in respect of the Selected
Project/Program from time to time and shall periodically upload the progress
report as per the format provided hereto in Schedule IV alongwith the
certificates confirming progress from independent entities and the end use
certificate certifying the utilisation of the Contribution Amount <span
style="mso-spacerun:yes"> </span>on the said Portal.<o:p></o:p></span></h2>

<p class=MsoNormal style="text-align:justify;tab-stops:66.75pt"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
Arial;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">6.3<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Contributor shall be entitled to supervise from
time to time the progress of the Selected Project/Program by doing such acts,
deeds and things including conducting evaluation visits and the Implementor will
facilitate and co-operate with Contributor for the same.<o:p></o:p></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-fareast-font-family:Arial;mso-bidi-font-family:
Arial"><o:p>&nbsp;</o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">6.4<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor shall assess the impact of the Selected
Project/Program and prepare a comprehensive final completion report of the Selected
Project/Program along with supporting documents which shall be submitted by the
Implementor on the said Portal within one month of Selected Project/Program being
incorporated, thus providing all details like scope of work met, objectives
attained, outcome and impact, financial details, details of the number of
beneficiaries, testimonials, significant change stories, major learning and
recommendations made by the Implementor for the perusal of the Contributor.<o:p></o:p></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-fareast-font-family:Arial;mso-bidi-font-family:
Arial"><o:p>&nbsp;</o:p></span></p>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><a
name="_Toc468732402"><![if !supportLists]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">7<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><u><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Accounts, Records and
Audit</span></u></a><span style="mso-bookmark:_Toc468732402"></span><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">:-<o:p></o:p></span></h1>

<p class=MsoNormal><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">7.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor shall maintain all accounting
records and documents to account for the Contribution Amount received from the Contributor.<o:p></o:p></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><span style="mso-spacerun:yes"> </span><span
style="mso-spacerun:yes">  </span><o:p></o:p></span></h2>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">7.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor will furnish a quarterly accounting
statement of funds received and their utilization to the Contributor on the
letterhead of the organization duly signed and stamped by the authorized
representative of the Implementor and other important accounts, documents,
records, reports but not limited to bank statements/balance sheets as and when
requested by the Contributor within a reasonable time frame of 15 days subject
to extension of further 15 days only.<o:p></o:p></span></h2>

<p class=MsoNormal><span style="font-family:DINPro-Regular;mso-fareast-font-family:
Arial"><o:p>&nbsp;</o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">7.3<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor shall quarterly upload the accounts
and audit reports in respect of the Selected Project / Program on the said Portal.
If the Contributor finds any errors or inaccuracies in the accounts &amp; records
maintained by the Implementor, the Implementor shall, within 30 days of a
written demand served by the Contributor, carry out suitable rectification, if
any in its accounts &amp; records, and inform the Contributor of the same
and/or otherwise. In the event the discrepancies as stated in the written demand
are not rectified then the Contributor shall have a right to terminate this Agreement
in the manner as stated in clause __ hereinabove.<o:p></o:p></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><a
name="_Toc468732403"><![if !supportLists]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">8<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><u><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Annual Audited Accounts
of the </span></u></a><u><span style="mso-bidi-font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial">Implementor</span></u><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">: -<o:p></o:p></span></h1>

<p class=MsoNormal><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">8.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor will submit annual audited accounts
along with an auditor’s certificate within 1 month of finalization for each of
the financial years covered by the Selected Project/Program during which the
Contributor is making the contribution. </span><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:Arial"><o:p></o:p></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">8.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The annual accounts shall be signed by the authorized
person of the Implementor and be certified by practicing chartered accountant.
This account should bear a certificate from the auditors confirming the total
receipt and expenditure in respect of the Implementor.<o:p></o:p></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><a
name="_Toc468732404"><![if !supportLists]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">9<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><u><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Tax </span></u></a><u><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">Aspects</span></u><span style="mso-bidi-font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial">: -<o:p></o:p></span></h1>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">9.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Tax Benefits: The Implementor shall provide all
necessary documentation to the Contributor in order to avail income tax
benefits under <b><u>Section 80G / 35 AC</u></b> of the Income Tax Act or other
Applicable Laws <span style="mso-spacerun:yes"> </span>as the case may be,
which is available to the Contributor in light of the Contribution Amount made by
the Contributor to the Implementor. <o:p></o:p></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">10<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><u><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Implementor </span></u><u><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Covenants by the Parties:
-<o:p></o:p></span></u></h1>

<p class=MsoNormal><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">10.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">By the Implementing Party<o:p></o:p></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial;mso-bidi-language:HI"><o:p>&nbsp;</o:p></span></p>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial;mso-bidi-language:HI"><span style="mso-list:Ignore">10.1.1<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp; </span></span></span><![endif]><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-language:
HI">That the Implementor shall not raise any objection and render its full
co-operation if the Contributor decides to collaborate with other companies for
undertaking Selected Project / Program in such a manner as the; Contributor may
deem fit. <o:p></o:p></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;text-indent:0in;mso-list:none"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-language:
HI"><o:p>&nbsp;</o:p></span></h2>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><a
name="_Toc30927222"></a><a name="_Toc29374349"></a><a name="_Toc29370556"></a><a
name="_Toc29368979"></a><a name="_Toc468732409"></a><a name="_Toc459315420"><span
style="mso-bookmark:_Toc468732409"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;
mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">11<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><u><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Role and Responsibility
of the </span></u></span></span></span></span></span></a><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><u><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">Implementor</span></u></span></span></span></span><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">: -<o:p></o:p></span></span></span></span></span></h1>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></span></span></span></h2>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">11.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor shall comply with all the terms,
conditions and obligations set out in this Agreement in the following manner: -<o:p></o:p></span></span></span></span></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></span></span></span></p>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">11.1.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">That the Implementor shall undertake to implement
the Selected Project / Program with utmost due diligence, efficiency and with
due regard to the judicious use of funds contributed by the Contributor.<o:p></o:p></span></span></span></span></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></span></span></span></p>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">11.1.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">That the Implementor and its staff, and any
persons, associations, institutions engaged by it shall ensure optimum level of
efficiency, due diligence and performance for the purposes of implementation of
the Selected Project/ Program;<o:p></o:p></span></span></span></span></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-language:HI"><o:p>&nbsp;</o:p></span></span></span></span></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">11.1.3<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">That the Implementor shall take full responsibility
for all the acts and omissions of its staff and any persons, associations,
institutions engaged by it for the purposes of implementation of the Selected Project/
Program;<o:p></o:p></span></span></span></span></span></h2>

<p class=MsoNormal><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></span></span></span></p>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">11.1.4<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor shall undertake and confirm to
intimate the Contributor within a reasonable time frame of 15 (fifteen) days of
any such disclosure/information which it perceives to have a negative/ adverse
impact on the Selected Project/Program and/or the Selected Project/ Program implementation
plan in respect thereof;<o:p></o:p></span></span></span></span></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></span></span></span></p>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">11.1.5<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Prior to seeking the respective installment, the Implementor,
shall submit all necessary information and relevant documents so as to enable
the Contributor to ascertain that the installments disbursed out of the
aggregate of the Contribution Amount has been utilized as per the Selected Project/
Proposal and it’s implementation plan to the absolute satisfaction of the
Contributor and the Implementor.<o:p></o:p></span></span></span></span></span></h2>

<p class=MsoNormal><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></span></span></span></p>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial;mso-bidi-language:HI"><span style="mso-list:Ignore">11.1.6<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp; </span></span></span><![endif]><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-language:
HI">That the Implementor shall not undertake any activity and/or utilize the </span></span></span></span></span><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular">Contribution</span></span></span></span></span><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-language:
HI"> Amount or any part thereof for any other Project/Program and/or activities
towards the expenditure incurred which is not in any way related or beneficial
to the </span></span></span></span></span><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Selected </span></span></span></span></span><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-language:
HI">Project/ Program.<o:p></o:p></span></span></span></span></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;text-indent:0in;mso-list:none"><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-language:
HI"><o:p>&nbsp;</o:p></span></span></span></span></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial;mso-bidi-language:HI"><span style="mso-list:Ignore">11.1.7<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp; </span></span></span><![endif]><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-language:
HI">That no part of the </span></span></span></span></span><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular">Contribution</span></span></span></span></span><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-language:
HI"> Amount shall form a part of the profit of the Implementor in due course of
its activities;<o:p></o:p></span></span></span></span></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><span style="mso-spacerun:yes">   </span><o:p></o:p></span></span></span></span></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">11.1.8<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">That the Implementor shall at all times abide by
the Pre-Disbursement Requirements as set out in clause __ hereinabove;<o:p></o:p></span></span></span></span></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;text-indent:0in;mso-list:none"><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></span></span></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">11.1.9<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">That the Implementor shall at all times abide by
the all the terms and conditions of this Agreement and other agreements/deeds/documents
executed in pursuance thereof and ensure that it does not violate any
covenants, conditions and stipulations of any of its existing agreements.<span
style="mso-spacerun:yes">  </span><o:p></o:p></span></span></span></span></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;text-indent:0in;mso-list:none"><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-language:
HI"><o:p>&nbsp;</o:p></span></span></span></span></span></h2>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial;mso-bidi-language:HI"><span style="mso-list:Ignore">11.1.10</span></span><![endif]><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-language:
HI">That the Implementor shall not raise any objection and render its full
co-operation in the event the Contributor decides to enter into an agreement or
collaborate with any other companies which are desirous of undertaking payment
of the balance Contribution Amount towards the Selected Project/Program. <o:p></o:p></span></span></span></span></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial;mso-bidi-language:HI"><o:p>&nbsp;</o:p></span></span></span></span></span></p>

<h2 style="margin-left:1.0in;mso-add-space:auto;mso-list:l7 level3 lfo1"><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">11.1.11</span></span><![endif]><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular">The Implementor shall
guarantee the correct and complete performance of all its obligations and
responsibilities under or in connection with this Agreement.<o:p></o:p></span></span></span></span></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></span></span></span></h2>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">11.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor shall comply with and implement the
Selected Project/Program as per the implementation plan detailed in the Schedule
II appended hereto.<o:p></o:p></span></span></span></span></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></span></span></span></p>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">11.3<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor represents that the information
given in the Project/ Program / Implementing Plan / Schedules and any prior or
subsequent information or explanation furnished on the said Portal by the Implementor
to the Contributor is and shall be true, bona fide and accurate in all material
respects.<o:p></o:p></span></span></span></span></span></h2>

<p class=MsoNormal><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></span></span></span></p>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">11.4<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor shall ensure that it has valid
exemptions under Section 80G and/ or other relevant provisions under the Income
Tax Act during the term of this Agreement.<o:p></o:p></span></span></span></span></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></span></span></span></h2>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">11.5<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor shall be responsible to perform the
Selected Project/Program with the best care, skill and diligence in accordance
with best practice in the relevant industry, profession or trade. <o:p></o:p></span></span></span></span></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></span></span></span></h2>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">11.6<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor shall notify the Contributor immediately
in writing if, at any time, it becomes aware that any of the representations or
warranties set out in this Agreement is no longer correct or of any
circumstance or event which would, or is likely to have a material adverse
effect on the Project or of any material loss or damage which the Implementor
may suffer due to the occurrence any likely event;<o:p></o:p></span></span></span></span></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></span></span></span></h2>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">11.7<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor shall notify the Contributor
immediately in writing if, at any time, it becomes aware that any proceedings
whether civil or criminal in nature has been initiated against the Implementor
and if any notice making any demands, claims of any costs, expenses, penalties
etc. on the Implementor is served. </span></span></span></span></span><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><span
style="font-family:DINPro-Regular"><o:p></o:p></span></span></span></span></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></span></span></span></h2>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">12<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><u><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Limitation of Liability
of the Contributor</span></u></span></span></span></span><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">:- <o:p></o:p></span></span></span></span></span></h1>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></span></span></span></h2>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">12.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">In no event shall the Contributor be liable for any
indirect or consequential loss, damage, cost or expense of any kind whatever
and however caused, whether arising under statute, contract, and tort or
otherwise under this Agreement.<o:p></o:p></span></span></span></span></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></span></span></span></p>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">12.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Contributor will not be responsible in any
manner whatsoever for the actual implementation of the Selected Project/Program.
The Contributor will also not be responsible for any claim, damage, loss or
harm that is caused to any person or property due the implementation or
non-implementation of the Selected Project/ Program. It is clarified that the
role and obligation of the Contributor will be confined only to providing the Contribution
Amount.<o:p></o:p></span></span></span></span></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></span></span></span></h2>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><span
style="mso-bookmark:_Toc29368979"><span style="mso-bookmark:_Toc29370556"><span
style="mso-bookmark:_Toc29374349"><span style="mso-bookmark:_Toc30927222"><a
name="_Toc468732407"><![if !supportLists]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">13<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><u><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Conflict of Interest</span></u></a></span></span></span></span><span
style="mso-bookmark:_Toc468732407"></span><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">:-<o:p></o:p></span></span></span></span></span></h1>

<p class=MsoNormal><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></span></span></span></p>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">13.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor itself and/or its staff, agent,
director, trustee, officers etc. or its personnel nor agent shall engage in any
business or professional activities,, which conflict with or could potentially
conflict with the object of the Selected Project/Porgram.<o:p></o:p></span></span></span></span></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bookmark:_Toc29368979"><span
style="mso-bookmark:_Toc29370556"><span style="mso-bookmark:_Toc29374349"><span
style="mso-bookmark:_Toc30927222"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></span></span></span></h2>

<span style="mso-bookmark:_Toc30927222"></span><span style="mso-bookmark:_Toc29374349"></span><span
style="mso-bookmark:_Toc29370556"></span><span style="mso-bookmark:_Toc29368979"></span>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><a
name="_Toc468732411"></a><a name="_Toc459315422"></a><a name="_Toc227644808"></a><a
name="_Toc121213952"></a><a name="_Toc87754486"></a><a name="_Toc37152390"></a><a
name="_Toc30932083"></a><a name="_Toc30927793"></a><a name="_Toc30927230"></a><a
name="_Toc29374357"></a><a name="_Toc29370564"></a><a name="_Toc29368987"></a><a
name="_Toc84305113"></a><a name="_Toc29271086"></a><a name="_Toc29270791"></a><a
name="_Toc227644805"></a><a name="_Toc121213951"></a><a name="_Toc87754485"></a><a
name="_Toc37152389"></a><a name="_Toc30932082"></a><a name="_Toc30927792"></a><a
name="_Toc30927229"></a><a name="_Toc29374356"></a><a name="_Toc29370563"></a><a
name="_Toc29368986"></a><a name="_Toc84305112"></a><a name="_DV_M328"></a><a
name="_DV_M329"></a><a name="_DV_M263"></a><a name="_DV_M264"></a><a
name="_DV_M266"></a><a name="_DV_M268"></a><a name="_DV_M272"></a><a
name="_DV_M274"></a><a name="_DV_M275"></a><a name="_DV_M277"></a><a
name="_DV_M278"></a><a name="_DV_M279"></a><a name="_DV_M280"></a><a
name="_DV_M281"></a><a name="_DV_M282"></a><a name="_DV_M283"></a><a
name="_DV_M284"></a><a name="_DV_M285"></a><![if !supportLists]><span
style="mso-bookmark:_Toc468732411"><span style="mso-bookmark:_Toc459315422"><span
style="mso-bookmark:_Toc227644808"><span style="mso-bookmark:_Toc121213952"><span
style="mso-bookmark:_Toc87754486"><span style="mso-bookmark:_Toc37152390"><span
style="mso-bookmark:_Toc30932083"><span style="mso-bookmark:_Toc30927793"><span
style="mso-bookmark:_Toc30927230"><span style="mso-bookmark:_Toc29374357"><span
style="mso-bookmark:_Toc29370564"><span style="mso-bookmark:_Toc29368987"><span
style="mso-bookmark:_Toc84305113"><span style="mso-bookmark:_Toc29271086"><span
style="mso-bookmark:_Toc29270791"><span style="mso-bookmark:_Toc227644805"><span
style="mso-bookmark:_Toc121213951"><span style="mso-bookmark:_Toc87754485"><span
style="mso-bookmark:_Toc37152389"><span style="mso-bookmark:_Toc30932082"><span
style="mso-bookmark:_Toc30927792"><span style="mso-bookmark:_Toc30927229"><span
style="mso-bookmark:_Toc29374356"><span style="mso-bookmark:_Toc29370563"><span
style="mso-bookmark:_Toc29368986"><span style="mso-bookmark:_Toc84305112"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">14<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span><![endif]><span
style="mso-bookmark:_Toc468732411"><span style="mso-bookmark:_Toc459315422"><span
style="mso-bookmark:_Toc227644808"><span style="mso-bookmark:_Toc121213952"><span
style="mso-bookmark:_Toc87754486"><span style="mso-bookmark:_Toc37152390"><span
style="mso-bookmark:_Toc30932083"><span style="mso-bookmark:_Toc30927793"><span
style="mso-bookmark:_Toc30927230"><span style="mso-bookmark:_Toc29374357"><span
style="mso-bookmark:_Toc29370564"><span style="mso-bookmark:_Toc29368987"><span
style="mso-bookmark:_Toc84305113"><span style="mso-bookmark:_Toc29271086"><span
style="mso-bookmark:_Toc29270791"><span style="mso-bookmark:_Toc227644805"><span
style="mso-bookmark:_Toc121213951"><span style="mso-bookmark:_Toc87754485"><span
style="mso-bookmark:_Toc37152389"><span style="mso-bookmark:_Toc30932082"><span
style="mso-bookmark:_Toc30927792"><span style="mso-bookmark:_Toc30927229"><span
style="mso-bookmark:_Toc29374356"><span style="mso-bookmark:_Toc29370563"><span
style="mso-bookmark:_Toc29368986"><span style="mso-bookmark:_Toc84305112"><u><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">Indemnity</span></u></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span><span
style="mso-bookmark:_Toc84305112"></span><span style="mso-bookmark:_Toc29368986"></span><span
style="mso-bookmark:_Toc29370563"></span><span style="mso-bookmark:_Toc29374356"></span><span
style="mso-bookmark:_Toc30927229"></span><span style="mso-bookmark:_Toc30927792"></span><span
style="mso-bookmark:_Toc30932082"></span><span style="mso-bookmark:_Toc37152389"></span><span
style="mso-bookmark:_Toc87754485"></span><span style="mso-bookmark:_Toc121213951"></span><span
style="mso-bookmark:_Toc227644805"></span><span style="mso-bookmark:_Toc468732411"><span
style="mso-bookmark:_Toc459315422"><span style="mso-bookmark:_Toc227644808"><span
style="mso-bookmark:_Toc121213952"><span style="mso-bookmark:_Toc87754486"><span
style="mso-bookmark:_Toc37152390"><span style="mso-bookmark:_Toc30932083"><span
style="mso-bookmark:_Toc30927793"><span style="mso-bookmark:_Toc30927230"><span
style="mso-bookmark:_Toc29374357"><span style="mso-bookmark:_Toc29370564"><span
style="mso-bookmark:_Toc29368987"><span style="mso-bookmark:_Toc84305113"><span
style="mso-bookmark:_Toc29271086"><span style="mso-bookmark:_Toc29270791"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">:- </span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span><a
name="_DV_M208"></a><a name="_DV_M209"></a><a name="_DV_M210"></a><a
name="_DV_M211"></a><a name="_DV_M214"></a><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p></o:p></span></h1>

<p class=MsoNormal><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><a name="_DV_M186"></a><a name="_DV_M187"></a><a
name="_DV_M188"></a><a name="_DV_M189"></a><a name="_DV_M190"></a><a
name="_DV_M191"></a><a name="_DV_M192"></a><a name="_DV_M193"></a><a
name="_DV_M194"></a><![if !supportLists]><span style="mso-bidi-font-size:11.0pt;
font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">14.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor shall indemnify, protect and save the
Contributor and hold the Contributor harmless from and against all claims,
losses, costs, damages, expenses, penalties, action suits and other
proceedings, (including reasonable attorney fees), relating to or resulting
from any act or omission or negligence or misconduct of the Implementor and
itself and representatives, officers, agents contractors and/or staff etc. on
account of breach of the terms and conditions of this Agreement, and/or if the representations,
warranties, covenants and/or if there are any statements by the Implementor are
found to be false or misleading, third party claims arising due to infringement
of Intellectual Property Rights, death or personal injury attributable to acts
or omission of the Implementor, violation of statutory and regulatory
provisions of the Applicable Laws. <o:p></o:p></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><a
name="_Toc121213953"></a><a name="_Toc87754487"></a><a name="_Toc37152391"></a><a
name="_Toc30932084"></a><a name="_Toc84305114"></a><a name="_Toc468732413"></a><a
name="_Toc459315425"></a><a name="_Toc227644811"></a><a name="_DV_M195"></a><a
name="_DV_M196"></a><a name="_DV_M198"></a><a name="_DV_M199"></a><a
name="_DV_M200"></a><a name="_DV_M201"></a><a name="_DV_M204"></a><a
name="_DV_M205"></a><a name="_DV_M206"></a><a name="_DV_M207"></a><![if !supportLists]><span
style="mso-bookmark:_Toc121213953"><span style="mso-bookmark:_Toc87754487"><span
style="mso-bookmark:_Toc37152391"><span style="mso-bookmark:_Toc30932084"><span
style="mso-bookmark:_Toc84305114"><span style="mso-bookmark:_Toc468732413"><span
style="mso-bookmark:_Toc459315425"><span style="mso-bookmark:_Toc227644811"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">15<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span></span></span></span></span></span></span></span></span><![endif]><span
style="mso-bookmark:_Toc121213953"><span style="mso-bookmark:_Toc87754487"><span
style="mso-bookmark:_Toc37152391"><span style="mso-bookmark:_Toc30932084"><span
style="mso-bookmark:_Toc84305114"><span style="mso-bookmark:_Toc468732413"><span
style="mso-bookmark:_Toc459315425"><span style="mso-bookmark:_Toc227644811"><u><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">Term and Termination</span></u></span></span></span></span></span></span></span></span><span
style="mso-bookmark:_Toc227644811"></span><span style="mso-bookmark:_Toc459315425"></span><span
style="mso-bookmark:_Toc468732413"></span><span style="mso-bookmark:_Toc121213953"><span
style="mso-bookmark:_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span
style="mso-bookmark:_Toc30932084"><span style="mso-bookmark:_Toc84305114"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">:-<o:p></o:p></span></span></span></span></span></span></h1>

<p class=MsoNormal><span style="mso-bookmark:_Toc121213953"><span
style="mso-bookmark:_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span
style="mso-bookmark:_Toc30932084"><span style="mso-bookmark:_Toc84305114"><span
style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></span></span></span></span></p>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc121213953"><span
style="mso-bookmark:_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span
style="mso-bookmark:_Toc30932084"><span style="mso-bookmark:_Toc84305114"><a
name="_Toc227644813"><![if !supportLists]><span style="mso-bidi-font-size:11.0pt;
font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">15.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><b><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Term <o:p></o:p></span></b></a></span></span></span></span></span></h2>

<h3 style="line-height:normal"><span style="mso-bookmark:_Toc121213953"><span
style="mso-bookmark:_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span
style="mso-bookmark:_Toc30932084"><span style="mso-bookmark:_Toc84305114"><span
style="mso-bookmark:_Toc227644813"><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></span></span></span></span></span></h3>

<h3 style="line-height:normal"><span style="mso-bookmark:_Toc121213953"><span
style="mso-bookmark:_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span
style="mso-bookmark:_Toc30932084"><span style="mso-bookmark:_Toc84305114"><span
style="mso-bookmark:_Toc227644813"><span style="font-family:DINPro-Regular">This
Agreement shall be deemed to come into force with effect from&lt;&lt;….&gt;&gt;
and shall be valid and effective till &lt;&lt;….&gt;&gt;, unless renewed by
mutual consent in writing of the Parties prior to expiry of this Agreement,
upon such terms and conditions as may be mutually agreed between the Parties.<o:p></o:p></span></span></span></span></span></span></span></h3>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bookmark:_Toc121213953"><span
style="mso-bookmark:_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span
style="mso-bookmark:_Toc30932084"><span style="mso-bookmark:_Toc84305114"><span
style="mso-bookmark:_Toc227644813"><b><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></b></span></span></span></span></span></span></h2>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc121213953"><span
style="mso-bookmark:_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span
style="mso-bookmark:_Toc30932084"><span style="mso-bookmark:_Toc84305114"><span
style="mso-bookmark:_Toc227644813"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">15.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><b><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Termination</span></b></span></span></span></span></span></span><span
style="mso-bookmark:_Toc121213953"><span style="mso-bookmark:_Toc87754487"><span
style="mso-bookmark:_Toc37152391"><span style="mso-bookmark:_Toc30932084"><span
style="mso-bookmark:_Toc84305114"><b><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p></o:p></span></b></span></span></span></span></span></h2>

<p class=MsoNormal><span style="mso-bookmark:_Toc121213953"><span
style="mso-bookmark:_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span
style="mso-bookmark:_Toc30932084"><span style="mso-bookmark:_Toc84305114"><span
style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></span></span></span></span></p>

<h3 style="line-height:normal"><span style="mso-bookmark:_Toc121213953"><span
style="mso-bookmark:_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span
style="mso-bookmark:_Toc30932084"><span style="mso-bookmark:_Toc84305114"><span
style="font-family:DINPro-Regular">The Contributor reserves the right to
terminate this Agreement before the expiry of Term upon serving a notice of 15
days to the Implementor in the following events as set out hereinafter:- <o:p></o:p></span></span></span></span></span></span></h3>

<h4 style="margin-left:1.0in;mso-add-space:auto;text-indent:0in;mso-list:none"><span
style="mso-bookmark:_Toc121213953"><span style="mso-bookmark:_Toc87754487"><span
style="mso-bookmark:_Toc37152391"><span style="mso-bookmark:_Toc30932084"><span
style="mso-bookmark:_Toc84305114"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></span></span></span></span></h4>

<h4 style="margin-left:76.5pt;mso-add-space:auto;text-indent:-40.5pt;
mso-list:l7 level3 lfo1"><span style="mso-bookmark:_Toc121213953"><span
style="mso-bookmark:_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span
style="mso-bookmark:_Toc30932084"><span style="mso-bookmark:_Toc84305114"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">15.2.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">unsatisfactory
performance of the </span></span></span></span></span></span><span
style="mso-bookmark:_Toc121213953"><span style="mso-bookmark:_Toc87754487"><span
style="mso-bookmark:_Toc37152391"><span style="mso-bookmark:_Toc30932084"><span
style="mso-bookmark:_Toc84305114"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Selected </span></span></span></span></span></span><span
style="mso-bookmark:_Toc121213953"><span style="mso-bookmark:_Toc87754487"><span
style="mso-bookmark:_Toc37152391"><span style="mso-bookmark:_Toc30932084"><span
style="mso-bookmark:_Toc84305114"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Project/Program by the Implementor;
<o:p></o:p></span></span></span></span></span></span></h4>

<h4 style="margin-left:76.5pt;mso-add-space:auto;text-indent:-40.5pt;
mso-list:none"><span style="mso-bookmark:_Toc121213953"><span style="mso-bookmark:
_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span style="mso-bookmark:
_Toc30932084"><span style="mso-bookmark:_Toc84305114"><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></span></span></span></span></h4>

<h4 style="margin-left:76.5pt;mso-add-space:auto;text-indent:-40.5pt;
mso-list:l7 level3 lfo1"><span style="mso-bookmark:_Toc121213953"><span
style="mso-bookmark:_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span
style="mso-bookmark:_Toc30932084"><span style="mso-bookmark:_Toc84305114"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">15.2.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">the Implementor is
involved in corrupt practices or misappropriation of any funds or assets;<o:p></o:p></span></span></span></span></span></span></h4>

<h4 style="margin-left:76.5pt;mso-add-space:auto;text-indent:-40.5pt;
mso-list:none"><span style="mso-bookmark:_Toc121213953"><span style="mso-bookmark:
_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span style="mso-bookmark:
_Toc30932084"><span style="mso-bookmark:_Toc84305114"><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></span></span></span></span></h4>

<h4 style="margin-left:76.5pt;mso-add-space:auto;text-indent:-40.5pt;
mso-list:l7 level3 lfo1"><span style="mso-bookmark:_Toc121213953"><span
style="mso-bookmark:_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span
style="mso-bookmark:_Toc30932084"><span style="mso-bookmark:_Toc84305114"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">15.2.3<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">the Implementor has violated
any of the provisions of this Agreement and any Schedules __ to __ appended
hereto; and/ or <o:p></o:p></span></span></span></span></span></span></h4>

<h4 style="margin-left:76.5pt;mso-add-space:auto;text-indent:-40.5pt;
mso-list:none"><span style="mso-bookmark:_Toc121213953"><span style="mso-bookmark:
_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span style="mso-bookmark:
_Toc30932084"><span style="mso-bookmark:_Toc84305114"><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></span></span></span></span></h4>

<h4 style="margin-left:76.5pt;mso-add-space:auto;text-indent:-40.5pt;
mso-list:l7 level3 lfo1"><span style="mso-bookmark:_Toc121213953"><span
style="mso-bookmark:_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span
style="mso-bookmark:_Toc30932084"><span style="mso-bookmark:_Toc84305114"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">15.2.4<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">the Implementor has been
served with any notice or if any litigation/proceedings are<span
style="mso-spacerun:yes">  </span>initiated against and by the Implementor.<o:p></o:p></span></span></span></span></span></span></h4>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc121213953"><span
style="mso-bookmark:_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span
style="mso-bookmark:_Toc30932084"><span style="mso-bookmark:_Toc84305114"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></span></span></span></span></p>

<h3 style="line-height:normal"><span style="mso-bookmark:_Toc121213953"><span
style="mso-bookmark:_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span
style="mso-bookmark:_Toc30932084"><span style="mso-bookmark:_Toc84305114"><span
style="font-family:DINPro-Regular">The Implementor reserves the right to
terminate this Agreement before the expiry of Term upon serving a notice of 15
days to the Contributor in the events of non-payment of Contribution as per the
agreed terms.<span style="mso-tab-count:1">                </span><o:p></o:p></span></span></span></span></span></span></h3>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc121213953"><span
style="mso-bookmark:_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span
style="mso-bookmark:_Toc30932084"><span style="mso-bookmark:_Toc84305114"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
Arial;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></span></span></span></span></p>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc121213953"><span
style="mso-bookmark:_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span
style="mso-bookmark:_Toc30932084"><span style="mso-bookmark:_Toc84305114"><a
name="_Toc227644814"></a><a name="_Ref146264171"></a><a name="_DV_M219"></a><![if !supportLists]><span
style="mso-bookmark:_Toc227644814"><span style="mso-bookmark:_Ref146264171"><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">15.3<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span></span></span><![endif]><span style="mso-bookmark:_Toc227644814"><span
style="mso-bookmark:_Ref146264171"><b><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Consequence of Termination:-<o:p></o:p></span></b></span></span></span></span></span></span></span></h2>

<p class=MsoNormal><span style="mso-bookmark:_Toc121213953"><span
style="mso-bookmark:_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span
style="mso-bookmark:_Toc30932084"><span style="mso-bookmark:_Toc84305114"><span
style="mso-bookmark:_Toc227644814"><span style="mso-bookmark:_Ref146264171"><span
style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></span></span></span></span></span></span></p>

<p class=MsoNormal style="margin-left:.5in"><span style="mso-bookmark:_Toc121213953"><span
style="mso-bookmark:_Toc87754487"><span style="mso-bookmark:_Toc37152391"><span
style="mso-bookmark:_Toc30932084"><span style="mso-bookmark:_Toc84305114"><span
style="mso-bookmark:_Toc227644814"><span style="mso-bookmark:_Ref146264171"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial;
mso-bidi-font-weight:bold">Upon Termination of this Agreement as set out in
clause &lt;&lt;…&gt;&gt; hereinabove, <o:p></o:p></span></span></span></span></span></span></span></span></p>

<h4 style="margin-left:76.5pt;mso-add-space:auto;text-indent:0in;mso-list:none"><span
style="mso-bookmark:_Toc121213953"><span style="mso-bookmark:_Toc87754487"><span
style="mso-bookmark:_Toc37152391"><span style="mso-bookmark:_Toc30932084"><span
style="mso-bookmark:_Toc84305114"><span style="mso-bookmark:_Toc227644814"><span
style="mso-bookmark:_Ref146264171"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></span></span></span></span></span></span></h4>

<h4 style="margin-left:76.5pt;mso-add-space:auto;text-indent:0in;mso-list:none"><span
style="mso-bookmark:_Toc121213953"><span style="mso-bookmark:_Toc87754487"><span
style="mso-bookmark:_Toc37152391"><span style="mso-bookmark:_Toc30932084"><span
style="mso-bookmark:_Toc84305114"><span style="mso-bookmark:_Toc227644814"><span
style="mso-bookmark:_Ref146264171"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">The Contributor shall be
entitled to stop any further disbursements of the Contribution Amount in terms
of the Schedule I despite if any is due. However, the Contributor on demand by
the Implementor may at its sole discretion decide to pay any such Contribution
Amount to the Implementor to implement the </span></span></span></span></span></span></span></span><span
style="mso-bookmark:_Toc121213953"><span style="mso-bookmark:_Toc87754487"><span
style="mso-bookmark:_Toc37152391"><span style="mso-bookmark:_Toc30932084"><span
style="mso-bookmark:_Toc84305114"><span style="mso-bookmark:_Toc227644814"><span
style="mso-bookmark:_Ref146264171"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Selected </span></span></span></span></span></span></span></span><span
style="mso-bookmark:_Toc121213953"><span style="mso-bookmark:_Toc87754487"><span
style="mso-bookmark:_Toc37152391"><span style="mso-bookmark:_Toc30932084"><span
style="mso-bookmark:_Toc84305114"><span style="mso-bookmark:_Toc227644814"><span
style="mso-bookmark:_Ref146264171"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Project/ Program and/or
perform any of its commitments related to the </span></span></span></span></span></span></span></span><span
style="mso-bookmark:_Toc121213953"><span style="mso-bookmark:_Toc87754487"><span
style="mso-bookmark:_Toc37152391"><span style="mso-bookmark:_Toc30932084"><span
style="mso-bookmark:_Toc84305114"><span style="mso-bookmark:_Toc227644814"><span
style="mso-bookmark:_Ref146264171"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Selected </span></span></span></span></span></span></span></span><span
style="mso-bookmark:_Toc121213953"><span style="mso-bookmark:_Toc87754487"><span
style="mso-bookmark:_Toc37152391"><span style="mso-bookmark:_Toc30932084"><span
style="mso-bookmark:_Toc84305114"><span style="mso-bookmark:_Toc227644814"><span
style="mso-bookmark:_Ref146264171"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Project/ Program up to
date of termination. </span></span></span></span></span></span></span></span><a
name="_Toc227644820"></a><a name="_Ref146263848"></a><a name="_Toc121213959"></a><a
name="_Toc87754493"></a><a name="_Toc37152397"></a><a name="_Toc84305120"></a><span
style="mso-bookmark:_Toc84305120"><span style="mso-bookmark:_Toc37152397"><span
style="mso-bookmark:_Toc87754493"><span style="mso-bookmark:_Toc121213959"><span
style="mso-bookmark:_Ref146263848"><span style="mso-bookmark:_Toc227644820"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial"><o:p></o:p></span></span></span></span></span></span></span></h4>

<h4 style="margin-left:0in;mso-add-space:auto;text-indent:0in;mso-list:none"><span
style="mso-bookmark:_Toc84305120"><span style="mso-bookmark:_Toc37152397"><span
style="mso-bookmark:_Toc87754493"><span style="mso-bookmark:_Toc121213959"><span
style="mso-bookmark:_Ref146263848"><span style="mso-bookmark:_Toc227644820"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial"><span style="mso-spacerun:yes"> </span><o:p></o:p></span></span></span></span></span></span></span></h4>

<h4 style="margin-left:76.5pt;mso-add-space:auto;text-indent:-40.5pt;
mso-list:l7 level3 lfo1"><span style="mso-bookmark:_Toc84305120"><span
style="mso-bookmark:_Toc37152397"><span style="mso-bookmark:_Toc87754493"><span
style="mso-bookmark:_Toc121213959"><span style="mso-bookmark:_Ref146263848"><span
style="mso-bookmark:_Toc227644820"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">15.3.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">The Implementor shall
submit full accounts of the </span></span></span></span></span></span></span><span
style="mso-bookmark:_Toc84305120"><span style="mso-bookmark:_Toc37152397"><span
style="mso-bookmark:_Toc87754493"><span style="mso-bookmark:_Toc121213959"><span
style="mso-bookmark:_Ref146263848"><span style="mso-bookmark:_Toc227644820"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular">Selected </span></span></span></span></span></span></span><span
style="mso-bookmark:_Toc84305120"><span style="mso-bookmark:_Toc37152397"><span
style="mso-bookmark:_Toc87754493"><span style="mso-bookmark:_Toc121213959"><span
style="mso-bookmark:_Ref146263848"><span style="mso-bookmark:_Toc227644820"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">Project/Program in writing taking into account all receipts and payments
and commitments incurred from the commencement of the </span></span></span></span></span></span></span><span
style="mso-bookmark:_Toc84305120"><span style="mso-bookmark:_Toc37152397"><span
style="mso-bookmark:_Toc87754493"><span style="mso-bookmark:_Toc121213959"><span
style="mso-bookmark:_Ref146263848"><span style="mso-bookmark:_Toc227644820"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular">Selected </span></span></span></span></span></span></span><span
style="mso-bookmark:_Toc84305120"><span style="mso-bookmark:_Toc37152397"><span
style="mso-bookmark:_Toc87754493"><span style="mso-bookmark:_Toc121213959"><span
style="mso-bookmark:_Ref146263848"><span style="mso-bookmark:_Toc227644820"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">Project/Program up to the termination. The Contributor or its
representative may carry out an audit of the accounts of the Implementor of
this Agreement along with the expenditure of accounts in respect of the </span></span></span></span></span></span></span><span
style="mso-bookmark:_Toc84305120"><span style="mso-bookmark:_Toc37152397"><span
style="mso-bookmark:_Toc87754493"><span style="mso-bookmark:_Toc121213959"><span
style="mso-bookmark:_Ref146263848"><span style="mso-bookmark:_Toc227644820"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular">Selected </span></span></span></span></span></span></span><span
style="mso-bookmark:_Toc84305120"><span style="mso-bookmark:_Toc37152397"><span
style="mso-bookmark:_Toc87754493"><span style="mso-bookmark:_Toc121213959"><span
style="mso-bookmark:_Ref146263848"><span style="mso-bookmark:_Toc227644820"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">Project/Program.<o:p></o:p></span></span></span></span></span></span></span></h4>

<h4 style="margin-left:76.5pt;mso-add-space:auto;text-indent:0in;mso-list:none"><span
style="mso-bookmark:_Toc84305120"><span style="mso-bookmark:_Toc37152397"><span
style="mso-bookmark:_Toc87754493"><span style="mso-bookmark:_Toc121213959"><span
style="mso-bookmark:_Ref146263848"><span style="mso-bookmark:_Toc227644820"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial"><o:p>&nbsp;</o:p></span></span></span></span></span></span></span></h4>

<h4 style="margin-left:76.5pt;mso-add-space:auto;text-indent:-40.5pt;
mso-list:l7 level3 lfo1"><span style="mso-bookmark:_Toc84305120"><span
style="mso-bookmark:_Toc37152397"><span style="mso-bookmark:_Toc87754493"><span
style="mso-bookmark:_Toc121213959"><span style="mso-bookmark:_Ref146263848"><span
style="mso-bookmark:_Toc227644820"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">15.3.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor shall return all of Contributor’s
Confidential Information, or at the Contributor’s option destroy any remaining
Confidential Information and certify that all such information has been
returned and no Confidential Information is withheld by the Implementor. </span></span></span></span></span></span></span><span
style="mso-bookmark:_Toc84305120"><span style="mso-bookmark:_Toc37152397"><span
style="mso-bookmark:_Toc87754493"><span style="mso-bookmark:_Toc121213959"><span
style="mso-bookmark:_Ref146263848"><span style="mso-bookmark:_Toc227644820"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial"><o:p></o:p></span></span></span></span></span></span></span></h4>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc84305120"><span
style="mso-bookmark:_Toc37152397"><span style="mso-bookmark:_Toc87754493"><span
style="mso-bookmark:_Toc121213959"><span style="mso-bookmark:_Ref146263848"><span
style="mso-bookmark:_Toc227644820"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></span></span></span></span></span></p>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><span
style="mso-bookmark:_Toc84305120"><span style="mso-bookmark:_Toc37152397"><span
style="mso-bookmark:_Toc87754493"><span style="mso-bookmark:_Toc121213959"><span
style="mso-bookmark:_Ref146263848"><span style="mso-bookmark:_Toc227644820"><a
name="_Toc468732414"></a><a name="_Toc459315427"><span style="mso-bookmark:
_Toc468732414"><![if !supportLists]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">16<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><u><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Intellectual Property
Rights</span></u></span></a></span></span></span></span></span></span><span
style="mso-bookmark:_Toc468732414"></span><span style="mso-bookmark:_Toc459315427"></span><span
style="mso-bookmark:_Toc84305120"><span style="mso-bookmark:_Toc37152397"><span
style="mso-bookmark:_Toc87754493"><span style="mso-bookmark:_Toc121213959"><span
style="mso-bookmark:_Ref146263848"><span style="mso-bookmark:_Toc227644820"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">:-<o:p></o:p></span></span></span></span></span></span></span></h1>

<p class=MsoNormal><span style="mso-bookmark:_Toc84305120"><span
style="mso-bookmark:_Toc37152397"><span style="mso-bookmark:_Toc87754493"><span
style="mso-bookmark:_Toc121213959"><span style="mso-bookmark:_Ref146263848"><span
style="mso-bookmark:_Toc227644820"><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></span></span></span></span></span></p>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc84305120"><span
style="mso-bookmark:_Toc37152397"><span style="mso-bookmark:_Toc87754493"><span
style="mso-bookmark:_Toc121213959"><span style="mso-bookmark:_Ref146263848"><span
style="mso-bookmark:_Toc227644820"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:Arial"><span
style="mso-list:Ignore">16.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Nothing contained in this AGREEMENT shall be
construed as granting to the Implementor, a license, right to use or interest
in any intellectual property, logo, trademark, commercial mark or goodwill of the
Contributor unless mutually agreed by the Parties in writing. <o:p></o:p></span></span></span></span></span></span></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc84305120"><span
style="mso-bookmark:_Toc37152397"><span style="mso-bookmark:_Toc87754493"><span
style="mso-bookmark:_Toc121213959"><span style="mso-bookmark:_Ref146263848"><span
style="mso-bookmark:_Toc227644820"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></span></span></span></span></span></p>

<span style="mso-bookmark:_Toc227644820"></span><span style="mso-bookmark:_Ref146263848"></span><span
style="mso-bookmark:_Toc121213959"></span><span style="mso-bookmark:_Toc87754493"></span><span
style="mso-bookmark:_Toc37152397"></span><span style="mso-bookmark:_Toc84305120"></span>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><a
name="_Toc227644821"></a><a name="_Toc468732415"></a><a name="_Toc459315429"></a><a
name="_Toc451370558"><span style="mso-bookmark:_Toc459315429"><span
style="mso-bookmark:_Toc468732415"><span style="mso-bookmark:_Toc227644821"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">17<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><u><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Confidentiality</span></u></span></span></span></a><span
style="mso-bookmark:_Toc468732415"></span><span style="mso-bookmark:_Toc459315429"></span><span
style="mso-bookmark:_Toc451370558"></span><span style="mso-bookmark:_Toc227644821"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">:-<o:p></o:p></span></span></h1>

<p class=MsoNormal><span style="mso-bookmark:_Toc227644821"><span
style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc227644821"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">17.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor shall treat all information, which
is disclosed to it as a result of the operation of this Agreement, as
Confidential Information, and shall keep the same confidential, maintain
secrecy of all such information of confidential nature and shall not, at any
time, divulge such or any part thereof to any third party except as may be
compelled by any court or agency of competent jurisdiction, or as otherwise
required by law, and shall also ensure that same is not disclosed to any person
voluntarily, accidentally or by mistake.<o:p></o:p></span></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bookmark:_Toc227644821"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></h2>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc227644821"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">17.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor shall undertake to ensure that the
obligations mentioned herein shall be informed and enforceable against all
employees, agents, sub-contractors, assignees who have access to Confidential
Information. The Implementor’s obligations under for the purposes of this Agreement
shall extend to the non-publicizing of any dispute arising out of this Agreement.
<o:p></o:p></span></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc227644821"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc227644821"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">17.3<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">In the event of disclosure of Confidential
Information to a third party save and except as stated in clause &lt;&lt;…&gt;&gt;
hereinabove, the Implementor shall reasonably endeavor to assist the
Contributor in recovering and preventing such third party from using, selling
or otherwise disseminating of such information. <o:p></o:p></span></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc227644821"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc227644821"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">17.4<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">This Clause shall survive the termination of the Agreement.<o:p></o:p></span></span></h2>

<p class=MsoNormalCxSpFirst style="text-align:justify;tab-stops:146.15pt"><span
style="mso-bookmark:_Toc227644821"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial"><span style="mso-tab-count:1">                                                                 </span><o:p></o:p></span></span></p>

<span style="font-size:11.0pt;line-height:115%;font-family:DINPro-Regular;
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
mso-ansi-language:EN-US;mso-fareast-language:EN-US;mso-bidi-language:AR-SA"><br
clear=all style="mso-special-character:line-break;page-break-before:always">
</span>

<p class=MsoNormal style="margin-bottom:10.0pt;line-height:115%"><span
style="mso-bookmark:_Toc227644821"><span style="font-size:11.0pt;line-height:
115%;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><span
style="mso-bookmark:_Toc227644821"><a name="_Toc468732416"></a><a
name="_Toc459315430"></a><a name="_Toc451370559"><span style="mso-bookmark:
_Toc459315430"><span style="mso-bookmark:_Toc468732416"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">18<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><u><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Notices</span></u></span></span></a></span><span
style="mso-bookmark:_Toc468732416"></span><span style="mso-bookmark:_Toc459315430"></span><span
style="mso-bookmark:_Toc451370559"></span><span style="mso-bookmark:_Toc227644821"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">:-<o:p></o:p></span></span></h1>

<p class=MsoNormal><span style="mso-bookmark:_Toc227644821"><span
style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc227644821"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">18.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Except as otherwise provided under this Agreement,
all notices, demands or requests or other communications required or permitted
to be given or delivered under this Agreement shall be in writing and shall be
deemed to have been duly given when received by the designated recipient.
Written notice may be delivered in person or be dispatched via postal means and
addressed as follows: <o:p></o:p></span></span></h2>

<p class=MsoNormalCxSpFirst style="text-align:justify"><span style="mso-bookmark:
_Toc227644821"><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<p class=MsoNormalCxSpMiddle style="margin-left:.5in;mso-add-space:auto;
text-align:justify"><span style="mso-bookmark:_Toc227644821"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">To
the Contributor <o:p></o:p></span></span></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify;text-indent:.5in;
mso-pagination:none"><span style="mso-bookmark:_Toc227644821"><b><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Attention:
&lt;&lt;…..&gt;&gt;<o:p></o:p></span></b></span></p>

<p class=MsoNormalCxSpMiddle style="margin-left:.5in;mso-add-space:auto;
text-align:justify"><span style="mso-bookmark:_Toc227644821"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">&lt;&lt;…..&gt;&gt;<o:p></o:p></span></span></p>

<p class=MsoNormalCxSpMiddle style="margin-left:.5in;mso-add-space:auto;
text-align:justify"><span style="mso-bookmark:_Toc227644821"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">&lt;&lt;…..&gt;&gt;<o:p></o:p></span></span></p>

<p class=MsoNormalCxSpMiddle style="margin-left:.5in;mso-add-space:auto;
text-align:justify"><span style="mso-bookmark:_Toc227644821"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">&lt;&lt;….&gt;&gt;<o:p></o:p></span></span></p>

<p class=MsoNormalCxSpMiddle style="margin-left:.5in;mso-add-space:auto;
text-align:justify"><span style="mso-bookmark:_Toc227644821"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<p class=MsoNormalCxSpMiddle style="margin-left:.5in;mso-add-space:auto;
text-align:justify"><span style="mso-bookmark:_Toc227644821"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">To
the &lt;&lt;…..&gt;&gt;<o:p></o:p></span></span></p>

<p class=MsoNormalCxSpMiddle style="margin-left:.5in;mso-add-space:auto;
text-align:justify"><span style="mso-bookmark:_Toc227644821"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">&lt;&lt;….&gt;&gt;<o:p></o:p></span></span></p>

<p class=MsoNormalCxSpMiddle style="margin-left:.5in;mso-add-space:auto;
text-align:justify"><span style="mso-bookmark:_Toc227644821"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">&lt;&lt;…..&gt;&gt;<o:p></o:p></span></span></p>

<p class=MsoNormalCxSpLast style="margin-left:.5in;mso-add-space:auto;
text-align:justify"><span style="mso-bookmark:_Toc227644821"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">&lt;&lt;…..&gt;&gt;<o:p></o:p></span></span></p>

<h1 style="text-indent:0in;mso-pagination:none;page-break-after:auto;
mso-list:none"><span style="mso-bookmark:_Toc227644821"><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></h1>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><span
style="mso-bookmark:_Toc227644821"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;
mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">19<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><u><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Use of the Contributor’s
Logo, Images and Trademarks</span></u></span><span style="mso-bookmark:_Toc227644821"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">:-<o:p></o:p></span></span></h1>

<p class=MsoNormal><span style="mso-bookmark:_Toc227644821"><span
style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc227644821"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">19.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor agrees not to use the name or logo
of the Contributor for any internal or external communication including but not
limited to poster, mailer, employee engagement collateral, channel collaterals,
outdoor/ advertising materials, radio/ television script and visuals, white
paper, case studies, presentations in any public forum and/or any interview,
unless prior written consent for the same is obtained from the Contributor.<o:p></o:p></span></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc227644821"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc227644821"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">19.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor hereby authorizes the Contributor to
use its name or logo for any internal and/or external communication with
respect to the Selected Project/Program and the Contributor’s engagement under
corporate social responsibility with the Implementor.<o:p></o:p></span></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc227644821"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><span
style="mso-bookmark:_Toc227644821"><![if !supportLists]><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;
mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">20<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><u><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Press Release</span></u></span><span
style="mso-bookmark:_Toc227644821"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">:-<o:p></o:p></span></span></h1>

<p class=MsoNormal><span style="mso-bookmark:_Toc227644821"><span
style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc227644821"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">20.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor agrees that it shall not use
information about this contribution of funds by the Contributor for marketing
purposes through its newsletter, press releases or through its website or make
any public announcements or press release in relation to the subject matter of
this Agreement, or its existence without the prior written consent of the
Contributor. <o:p></o:p></span></span></h2>

<p class=MsoNormal style="margin-left:.5in;mso-add-space:auto;text-align:justify"><span
style="mso-bookmark:_Toc227644821"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<span style="mso-bookmark:_Toc227644821"></span>

<h1 style="mso-pagination:none;page-break-after:auto;mso-list:l7 level1 lfo1"><a
name="_Toc468732421"></a><a name="_Toc459315438"></a><a name="_Toc227644822"></a><a
name="_DV_M249"></a><a name="_DV_M250"></a><a name="_DV_M251"></a><a
name="_DV_M252"></a><a name="_DV_M253"></a><a name="_DV_M254"></a><a
name="_DV_M255"></a><![if !supportLists]><span style="mso-bookmark:_Toc468732421"><span
style="mso-bookmark:_Toc459315438"><span style="mso-bookmark:_Toc227644822"><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">21<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span></span></span></span><![endif]><span style="mso-bookmark:
_Toc468732421"><span style="mso-bookmark:_Toc459315438"><span style="mso-bookmark:
_Toc227644822"><u><span style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">General Terms</span></u></span></span></span><span
style="mso-bookmark:_Toc227644822"></span><span style="mso-bookmark:_Toc459315438"></span><span
style="mso-bookmark:_Toc468732421"></span><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">:-<o:p></o:p></span></h1>

<p class=MsoNormal><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">21.1<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Compliance with Applicable Laws of India: <o:p></o:p></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">The Implementor shall undertake to observe, adhere
to, abide by, comply with and keep the Contributor informed about all
laws/rules/regulations including legal and statutory compliances, Government
Regulations and Guidelines, compliance of labor laws and other laws in force or
as are or as made applicable in future, pertaining to or applicable to them, the
Selected Project/Program and all purposes of this Agreement and shall
indemnify, keep indemnified, hold harmless, defend and protect the Contributor and
its officers / staff / personnel / representatives / agents from any failure or
omission on its part to do so and against all claims or demands of liability
and all consequences that may occur or arise for any default or failure on its
part to conform or comply with the above and all other statutory or regulatory
obligations arising there from.<o:p></o:p></span></h2>

<p class=MsoNormal style="text-align:justify;mso-pagination:none"><a
name="_DV_M167"></a><a name="_DV_M168"></a><a name="_DV_M169"></a><a
name="_DV_M170"></a><a name="_DV_M171"></a><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><a name="_Toc227644824"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">21.2<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Force Majeure</span></a><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular">: The Parties to this Agreement shall not be
held liable in the event of Force Majeure, or any other unavoidable event that
prevents the parties from carrying out its duties, roles and responsibilities
under this Agreement pursuant to judicial orders, regulatory provisions, war
(declared or undeclared), terrorist acts, general mobilization, earthquakes or
any other natural disaster and strikes. If the event of Force Majeure continues
for a period of more than &lt;&lt;….&gt;&gt; days, the Contributor shall be
entitled to terminate this Agreement at any time thereafter without notice.
However, the Implementor shall not have the right to terminate the Agreement and
shall continue to perform their obligations as far as possible under this Agreement,
unless otherwise directed by the Contributor in writing. <o:p></o:p></span></h2>

<h3 style="line-height:normal"><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h3>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial;mso-bidi-font-weight:normal"><span style="mso-list:Ignore">21.3<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-weight:
normal">Disputes: If any dispute arises between the parties hereto in
connection with or arising out of this Agreement, the dispute shall be referred
to arbitration under the Indian Arbitration and Conciliation Act, 1996 by a
sole arbitrator mutually agreed upon.<span style="mso-spacerun:yes">  </span>In
the absence of consensus about the single arbitrator, the dispute may be
referred to joint arbitrators, one to be nominated by each party and the said
arbitrators shall nominate a presiding arbitrator, before commencing the
arbitration proceedings. Arbitration shall be held in Mumbai, India. The
proceedings of arbitration shall be in the English language. The arbitrator’s
award shall be final and binding on the parties.<o:p></o:p></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><a name="_Toc459315437"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial;mso-bidi-font-weight:normal"><span style="mso-list:Ignore">21.4<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-weight:
normal">G</span></a><span style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-weight:normal">overning Language: All correspondences and other
documents pertaining to this Agreement shall be in English only.<o:p></o:p></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><a name="_Toc227644832"></a><a
name="_Toc121213958"></a><a name="_Toc87754492"></a><a name="_Toc37152396"></a><a
name="_Toc30932089"></a><a name="_Toc30927800"></a><a name="_Toc30927237"></a><a
name="_Toc29374369"></a><a name="_Toc29370576"></a><a name="_Toc29368995"></a><a
name="_Toc84305119"></a><a name="_DV_M181"></a><a name="_DV_M184"></a><a
name="_DV_M229"></a><a name="_Toc516454711"></a><a name="_Toc516455803"></a><a
name="_Toc516454712"></a><a name="_Toc516455804"></a><a name="_DV_M230"></a><a
name="_DV_M231"></a><a name="_DV_M243"></a><![if !supportLists]><span
style="mso-bookmark:_Toc227644832"><span style="mso-bookmark:_Toc121213958"><span
style="mso-bookmark:_Toc87754492"><span style="mso-bookmark:_Toc37152396"><span
style="mso-bookmark:_Toc30932089"><span style="mso-bookmark:_Toc30927800"><span
style="mso-bookmark:_Toc30927237"><span style="mso-bookmark:_Toc29374369"><span
style="mso-bookmark:_Toc29370576"><span style="mso-bookmark:_Toc29368995"><span
style="mso-bookmark:_Toc84305119"><span style="mso-bidi-font-size:11.0pt;
font-family:"Arial",sans-serif;mso-fareast-font-family:Arial;mso-bidi-font-weight:
normal"><span style="mso-list:Ignore">21.5<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span></span></span></span></span></span></span></span></span></span></span></span><![endif]><span
style="mso-bookmark:_Toc227644832"><span style="mso-bookmark:_Toc121213958"><span
style="mso-bookmark:_Toc87754492"><span style="mso-bookmark:_Toc37152396"><span
style="mso-bookmark:_Toc30932089"><span style="mso-bookmark:_Toc30927800"><span
style="mso-bookmark:_Toc30927237"><span style="mso-bookmark:_Toc29374369"><span
style="mso-bookmark:_Toc29370576"><span style="mso-bookmark:_Toc29368995"><span
style="mso-bookmark:_Toc84305119"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-weight:normal">Governing Law</span></span></span></span></span></span></span></span></span></span></span></span><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-weight:
normal">: This Agreement shall be governed exclusively by the laws of India and
jurisdiction shall be vested exclusively in the courts at Mumbai in India.<o:p></o:p></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><a name="_DV_M246"></a><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">21.6<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Assignment and Transfer<o:p></o:p></span></h2>

<h3 style="line-height:normal"><span style="font-family:DINPro-Regular">The Implementor
shall not have the right to assign any of its rights, benefits or obligations
under this Agreement. <o:p></o:p></span></h3>

<p class=MsoNormal style="text-align:justify;mso-pagination:none"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><a name="_Toc451370563"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">21.7<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">No Partnership or Agency: Nothing in this Agreement
is intended to, or shall be deemed to, establish any partnership or joint
venture between any of the parties, constitute any party the agent of another
party, or authorize any party to make or enter into any commitments for or on
behalf of any other party. <o:p></o:p></span></a></h2>

<p class=MsoListParagraph style="margin-left:.55in;mso-add-space:auto;
text-align:justify;mso-hyphenate:none"><span style="mso-bookmark:_Toc451370563"><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc451370563"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">21.8<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Amendments: This Agreement may not be amended,
modified or altered except by written consent of the other Party.<o:p></o:p></span></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc451370563"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<h2 style="mso-list:l7 level2 lfo1"><span style="mso-bookmark:_Toc451370563"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">21.9<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Waivers</span></span><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular">: </span><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:Arial">Nothing herein
shall be construed as a waiver of any right or a condition under this Agreement
unless it is done expressly in writing.</span><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular"> No course of dealing or failure of any
party to strictly enforce any term, right or condition of this Agreement shall
be construed as a waiver of such term, right or condition. Waiver by either
party of any default by the other party shall not be deemed a waiver of any
other default.<o:p></o:p></span></h2>

<h2 style="text-indent:0in;mso-list:none"><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">21.10<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Schedules: All Schedules hereto shall be deemed to
form an integral part of this Agreement.<o:p></o:p></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<h2 style="mso-list:l7 level2 lfo1"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
Arial"><span style="mso-list:Ignore">21.11<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Counterparts: This Agreement may be executed in
counterparts, each of which shall be an original, but all such counterparts
together constitute but one and the same document. <o:p></o:p></span></h2>

<p class=MsoNormal style="text-align:justify"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoFooterCxSpFirst style="text-align:justify;mso-pagination:none;
tab-stops:.5in"><b style="mso-bidi-font-weight:normal"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">IN WITNESS
WHEREOF</span></b><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">, the parties authorized representatives have
executed this AGREEMENT as of the date written above.<o:p></o:p></span></p>

<p class=MsoFooterCxSpLast style="text-align:justify;mso-pagination:none;
tab-stops:.5in"><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width="100%"
 style="width:100.0%;border-collapse:collapse;mso-padding-alt:0in 5.4pt 0in 5.4pt">
 <tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes">
  <td width="49%" colspan=4 valign=top style="width:49.98%;padding:5.0pt 5.0pt 5.0pt 5.0pt">
  <p class=MsoNormalCxSpFirst style="text-align:justify;mso-pagination:none"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">SIGNED:<o:p></o:p></span></p>
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-pagination:none"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">For
  and on behalf of<o:p></o:p></span></p>
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-pagination:none"><b
  style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;font-family:
  DINPro-Regular;mso-bidi-font-family:Arial;color:red">&lt;&lt;NAME OF
  IMPLEMENTOR&gt;&gt;<o:p></o:p></span></b></p>
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-pagination:none"><b
  style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;font-family:
  DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-pagination:none"><v:rect
   id="Rectangle_x0020_1" o:spid="_x0000_s1027" style="position:absolute;
   left:0;text-align:left;margin-left:-2.05pt;margin-top:2.5pt;width:175.4pt;
   height:73.1pt;z-index:251659264;visibility:visible;mso-wrap-style:square;
   mso-wrap-distance-left:9pt;mso-wrap-distance-top:0;
   mso-wrap-distance-right:9pt;mso-wrap-distance-bottom:0;
   mso-position-horizontal:absolute;mso-position-horizontal-relative:text;
   mso-position-vertical:absolute;mso-position-vertical-relative:text;
   v-text-anchor:middle" o:gfxdata="UEsDBBQABgAIAAAAIQC2gziS/gAAAOEBAAATAAAAW0NvbnRlbnRfVHlwZXNdLnhtbJSRQU7DMBBF
90jcwfIWJU67QAgl6YK0S0CoHGBkTxKLZGx5TGhvj5O2G0SRWNoz/78nu9wcxkFMGNg6quQqL6RA
0s5Y6ir5vt9lD1JwBDIwOMJKHpHlpr69KfdHjyxSmriSfYz+USnWPY7AufNIadK6MEJMx9ApD/oD
OlTrorhX2lFEilmcO2RdNtjC5xDF9pCuTyYBB5bi6bQ4syoJ3g9WQ0ymaiLzg5KdCXlKLjvcW893
SUOqXwnz5DrgnHtJTxOsQfEKIT7DmDSUCaxw7Rqn8787ZsmRM9e2VmPeBN4uqYvTtW7jvijg9N/y
JsXecLq0q+WD6m8AAAD//wMAUEsDBBQABgAIAAAAIQA4/SH/1gAAAJQBAAALAAAAX3JlbHMvLnJl
bHOkkMFqwzAMhu+DvYPRfXGawxijTi+j0GvpHsDYimMaW0Yy2fr2M4PBMnrbUb/Q94l/f/hMi1qR
JVI2sOt6UJgd+ZiDgffL8ekFlFSbvV0oo4EbChzGx4f9GRdb25HMsYhqlCwG5lrLq9biZkxWOiqY
22YiTra2kYMu1l1tQD30/bPm3wwYN0x18gb45AdQl1tp5j/sFB2T0FQ7R0nTNEV3j6o9feQzro1i
OWA14Fm+Q8a1a8+Bvu/d/dMb2JY5uiPbhG/ktn4cqGU/er3pcvwCAAD//wMAUEsDBBQABgAIAAAA
IQCSd9ZceAIAAEQFAAAOAAAAZHJzL2Uyb0RvYy54bWysVE1v2zAMvQ/YfxB0X50YTT+COkXQosOA
oi2aDj2rshQbkESNUuJkv36U7LhFW+wwLAdFFMlH8flRF5c7a9hWYWjBVXx6NOFMOQl169YV//l0
8+2MsxCFq4UBpyq+V4FfLr5+uej8XJXQgKkVMgJxYd75ijcx+nlRBNkoK8IReOXIqQGtiGTiuqhR
dIRuTVFOJidFB1h7BKlCoNPr3skXGV9rJeO91kFFZipOd4t5xby+pLVYXIj5GoVvWjlcQ/zDLaxo
HRUdoa5FFGyD7Qco20qEADoeSbAFaN1KlXugbqaTd92sGuFV7oXICX6kKfw/WHm3fUDW1vTtOHPC
0id6JNKEWxvFpomezoc5Ra38Aw5WoG3qdafRpn/qgu0ypfuRUrWLTNJhWZansxPCluQ7L8+mswxa
vGZ7DPG7AsvSpuJI1TOTYnsbIlWk0ENIKubgpjUmnaeL9VfJu7g3KgUY96g0dZSKZ6CsJXVlkG0F
qUBIqVyc9q5G1Ko/nk3ol/qlemNGtjJgQtZUeMQeAJJOP2L3MEN8SlVZimPy5G8X65PHjFwZXByT
besAPwMw1NVQuY8/kNRTk1h6gXpP3xuhH4Tg5U1LtN+KEB8EkvJpRmia4z0t2kBXcRh2nDWAvz87
T/EkSPJy1tEkVTz82ghUnJkfjqR6Pj0+TqOXjePZaUkGvvW8vPW4jb0C+kwkGbpd3qb4aA5bjWCf
aeiXqSq5hJNUu+Iy4sG4iv2E07Mh1XKZw2jcvIi3buVlAk+sJlk97Z4F+kF7kVR7B4epE/N3Euxj
U6aD5SaCbrM+X3kd+KZRzcIZnpX0Fry1c9Tr47f4AwAA//8DAFBLAwQUAAYACAAAACEABhY4Ut8A
AAAIAQAADwAAAGRycy9kb3ducmV2LnhtbEyPwU7DMBBE70j8g7VI3FonpS0oxKlKJU5ApTSAxM21
lyQQr6PYbQNfz3KC42qeZt/kq9F14ohDaD0pSKcJCCTjbUu1gufqfnIDIkRNVneeUMEXBlgV52e5
zqw/UYnHXawFl1DItIImxj6TMpgGnQ5T3yNx9u4HpyOfQy3toE9c7jo5S5KldLol/tDoHjcNms/d
wSnAl9eP8vvtwWwfzdqXtInVXfWk1OXFuL4FEXGMfzD86rM6FOy09weyQXQKJvOUSQULXsTx1Xx5
DWLP3CKdgSxy+X9A8QMAAP//AwBQSwECLQAUAAYACAAAACEAtoM4kv4AAADhAQAAEwAAAAAAAAAA
AAAAAAAAAAAAW0NvbnRlbnRfVHlwZXNdLnhtbFBLAQItABQABgAIAAAAIQA4/SH/1gAAAJQBAAAL
AAAAAAAAAAAAAAAAAC8BAABfcmVscy8ucmVsc1BLAQItABQABgAIAAAAIQCSd9ZceAIAAEQFAAAO
AAAAAAAAAAAAAAAAAC4CAABkcnMvZTJvRG9jLnhtbFBLAQItABQABgAIAAAAIQAGFjhS3wAAAAgB
AAAPAAAAAAAAAAAAAAAAANIEAABkcnMvZG93bnJldi54bWxQSwUGAAAAAAQABADzAAAA3gUAAAAA
" filled="f" strokecolor="#243f60 [1604]" strokeweight="2pt"/><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p></o:p></span></p>
  </td>
  <td width="50%" colspan=2 valign=top style="width:50.02%;padding:5.0pt 5.0pt 5.0pt 5.0pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-pagination:none"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">SIGNED:<o:p></o:p></span></p>
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-pagination:none"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">For
  and on behalf of<o:p></o:p></span></p>
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-pagination:none"><b
  style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;font-family:
  DINPro-Regular;mso-bidi-font-family:Arial;color:red">&lt;&lt;NAME OF CONTRIBUTOR&gt;&gt;<o:p></o:p></span></b></p>
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-pagination:none"><b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-pagination:none"><v:rect
   id="Rectangle_x0020_2" o:spid="_x0000_s1026" style="position:absolute;
   left:0;text-align:left;margin-left:-2.25pt;margin-top:1.95pt;width:175.35pt;
   height:73.05pt;z-index:251661312;visibility:visible;mso-wrap-style:square;
   mso-wrap-distance-left:9pt;mso-wrap-distance-top:0;
   mso-wrap-distance-right:9pt;mso-wrap-distance-bottom:0;
   mso-position-horizontal:absolute;mso-position-horizontal-relative:text;
   mso-position-vertical:absolute;mso-position-vertical-relative:text;
   v-text-anchor:middle" o:gfxdata="UEsDBBQABgAIAAAAIQC2gziS/gAAAOEBAAATAAAAW0NvbnRlbnRfVHlwZXNdLnhtbJSRQU7DMBBF
90jcwfIWJU67QAgl6YK0S0CoHGBkTxKLZGx5TGhvj5O2G0SRWNoz/78nu9wcxkFMGNg6quQqL6RA
0s5Y6ir5vt9lD1JwBDIwOMJKHpHlpr69KfdHjyxSmriSfYz+USnWPY7AufNIadK6MEJMx9ApD/oD
OlTrorhX2lFEilmcO2RdNtjC5xDF9pCuTyYBB5bi6bQ4syoJ3g9WQ0ymaiLzg5KdCXlKLjvcW893
SUOqXwnz5DrgnHtJTxOsQfEKIT7DmDSUCaxw7Rqn8787ZsmRM9e2VmPeBN4uqYvTtW7jvijg9N/y
JsXecLq0q+WD6m8AAAD//wMAUEsDBBQABgAIAAAAIQA4/SH/1gAAAJQBAAALAAAAX3JlbHMvLnJl
bHOkkMFqwzAMhu+DvYPRfXGawxijTi+j0GvpHsDYimMaW0Yy2fr2M4PBMnrbUb/Q94l/f/hMi1qR
JVI2sOt6UJgd+ZiDgffL8ekFlFSbvV0oo4EbChzGx4f9GRdb25HMsYhqlCwG5lrLq9biZkxWOiqY
22YiTra2kYMu1l1tQD30/bPm3wwYN0x18gb45AdQl1tp5j/sFB2T0FQ7R0nTNEV3j6o9feQzro1i
OWA14Fm+Q8a1a8+Bvu/d/dMb2JY5uiPbhG/ktn4cqGU/er3pcvwCAAD//wMAUEsDBBQABgAIAAAA
IQBUeODBeAIAAEQFAAAOAAAAZHJzL2Uyb0RvYy54bWysVFFP2zAQfp+0/2D5faTNWhgVKapATJMQ
IGDi2Th2E8n2eWe3affrd3bSgADtYVofXNt3993dl+98dr6zhm0VhhZcxadHE86Uk1C3bl3xn49X
X75xFqJwtTDgVMX3KvDz5edPZ51fqBIaMLVCRiAuLDpf8SZGvyiKIBtlRTgCrxwZNaAVkY64LmoU
HaFbU5STyXHRAdYeQaoQ6PayN/JlxtdayXirdVCRmYpTbTGvmNfntBbLM7FYo/BNK4cyxD9UYUXr
KOkIdSmiYBts30HZViIE0PFIgi1A61aq3AN1M5286eahEV7lXoic4Eeawv+DlTfbO2RtXfGSMycs
faJ7Ik24tVGsTPR0PizI68Hf4XAKtE297jTa9E9dsF2mdD9SqnaRSbosy/L4dDbnTJLttDw5+TpP
oMVLtMcQvyuwLG0qjpQ9Mym21yH2rgeXlMzBVWtMuk+F9aXkXdwblRyMu1eaOkrJM1DWkrowyLaC
VCCkVC5Oe1MjatVfzyf0G0obI3KhGTAha0o8Yg8ASafvsfuyB/8UqrIUx+DJ3wrrg8eInBlcHINt
6wA/AjDU1ZC59z+Q1FOTWHqGek/fG6EfhODlVUu0X4sQ7wSS8mlGaJrjLS3aQFdxGHacNYC/P7pP
/iRIsnLW0SRVPPzaCFScmR+OpHo6nc3S6OXDbH5S0gFfW55fW9zGXgB9pim9G17mbfKP5rDVCPaJ
hn6VspJJOEm5Ky4jHg4XsZ9wejakWq2yG42bF/HaPXiZwBOrSVaPuyeBftBeJNXewGHqxOKNBHvf
FOlgtYmg26zPF14HvmlUs3CGZyW9Ba/P2evl8Vv+AQAA//8DAFBLAwQUAAYACAAAACEA/3mvK+AA
AAAIAQAADwAAAGRycy9kb3ducmV2LnhtbEyPy07DMBBF90j8gzVI7FqHvgQhTlUqsQIqpWmR2Ln2
kATicRS7beDrGVawHN2je89ky8G14oR9aDwpuBknIJCMtw1VCnbl4+gWRIiarG49oYIvDLDMLy8y
nVp/pgJP21gJLqGQagV1jF0qZTA1Oh3GvkPi7N33Tkc++0raXp+53LVykiQL6XRDvFDrDtc1ms/t
0SnA/etH8f32ZDbPZuULWsfyoXxR6vpqWN2DiDjEPxh+9VkdcnY6+CPZIFoFo9mcSQXTOxAcT2eL
CYgDc/MkAZln8v8D+Q8AAAD//wMAUEsBAi0AFAAGAAgAAAAhALaDOJL+AAAA4QEAABMAAAAAAAAA
AAAAAAAAAAAAAFtDb250ZW50X1R5cGVzXS54bWxQSwECLQAUAAYACAAAACEAOP0h/9YAAACUAQAA
CwAAAAAAAAAAAAAAAAAvAQAAX3JlbHMvLnJlbHNQSwECLQAUAAYACAAAACEAVHjgwXgCAABEBQAA
DgAAAAAAAAAAAAAAAAAuAgAAZHJzL2Uyb0RvYy54bWxQSwECLQAUAAYACAAAACEA/3mvK+AAAAAI
AQAADwAAAAAAAAAAAAAAAADSBAAAZHJzL2Rvd25yZXYueG1sUEsFBgAAAAAEAAQA8wAAAN8FAAAA
AA==
" filled="f" strokecolor="#243f60 [1604]" strokeweight="2pt"/><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:1;mso-yfti-lastrow:yes">
  <td width="11%" valign=top style="width:11.32%;padding:0in 0in 0in 0in">
  <p class=MsoNormal style="margin-bottom:10.0pt;line-height:115%"><span
  style="font-size:11.0pt;line-height:115%;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="35%" valign=top style="width:35.1%;padding:0in 0in 0in 0in">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;margin-right:.1in;
  margin-bottom:0in;margin-left:.1in;margin-bottom:.0001pt;mso-add-space:auto;
  text-align:justify;mso-pagination:none"><span style="font-size:11.0pt;
  font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="2%" valign=top style="width:2.7%;padding:0in 0in 0in 0in">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;margin-right:.1in;
  margin-bottom:0in;margin-left:.1in;margin-bottom:.0001pt;mso-add-space:auto;
  text-align:justify;mso-pagination:none"><span style="font-size:11.0pt;
  font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="11%" colspan=2 valign=top style="width:11.02%;padding:0in 0in 0in 0in">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;margin-right:.1in;
  margin-bottom:0in;margin-left:.1in;margin-bottom:.0001pt;mso-add-space:auto;
  text-align:justify;mso-pagination:none"><span style="font-size:11.0pt;
  font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="39%" valign=top style="width:39.86%;padding:0in 0in 0in 0in">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;margin-right:.1in;
  margin-bottom:0in;margin-left:.1in;margin-bottom:.0001pt;mso-add-space:auto;
  text-align:justify;mso-pagination:none"><span style="font-size:11.0pt;
  font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <![if !supportMisalignedColumns]>
 <tr height=0>
  <td width=80 style="border:none"></td>
  <td width=249 style="border:none"></td>
  <td width=19 style="border:none"></td>
  <td width=6 style="border:none"></td>
  <td width=72 style="border:none"></td>
  <td width=282 style="border:none"></td>
 </tr>
 <![endif]>
</table>

<p class=MsoFooter style="text-align:justify;mso-pagination:none;tab-stops:
.5in"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial"><o:p>&nbsp;</o:p></span></p>

<span style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
"Times New Roman";mso-bidi-font-family:Arial;mso-ansi-language:EN-US;
mso-fareast-language:EN-US;mso-bidi-language:AR-SA"><br clear=all
style="mso-special-character:line-break;page-break-before:always">
</span>

<p class=MsoNormal align=center style="text-align:center"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoFooterCxSpFirst align=center style="text-align:center;mso-pagination:
none;tab-stops:.5in"><b style="mso-bidi-font-weight:normal"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Schedule
I:<o:p></o:p></span></b></p>

<p class=MsoFooterCxSpMiddle align=center style="text-align:center;mso-pagination:
none;tab-stops:.5in"><b style="mso-bidi-font-weight:normal"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoFooterCxSpLast align=center style="text-align:center;mso-pagination:
none;tab-stops:.5in"><b><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Selected Project / Program Proposal </span></b><b
style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial"><o:p></o:p></span></b></p>

<p class=MsoNormalCxSpFirst align=center style="text-align:center"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">(<i
style="mso-bidi-font-style:normal">Please provide the complete objective and
the scope of work for the Selected Project / Program. Please clearly state the
geography of impact, beneficiary category, expected beneficiary count [direct
and indirect], expected project duration)<o:p></o:p></i></span></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">This should be
exactly as per the Project / Program uploaded on the Portal as selected by the
Contributor<o:p></o:p></span></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<b style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:Arial;mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA"><br clear=all style="mso-special-character:line-break;
page-break-before:always">
</span></b>

<p class=MsoNormal><b style="mso-bidi-font-weight:normal"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center;mso-layout-grid-align:
none;text-autospace:none"><b style="mso-bidi-font-weight:normal"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Schedule
II<o:p></o:p></span></b></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center;mso-layout-grid-align:
none;text-autospace:none"><b style="mso-bidi-font-weight:normal"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Selected
Project / Program implementation plan:<o:p></o:p></span></b></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center;mso-layout-grid-align:
none;text-autospace:none"><i style="mso-bidi-font-style:normal"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">(Please
provide the manner in which Selected Project / Program will be implemented)<o:p></o:p></span></i></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center;mso-layout-grid-align:
none;text-autospace:none"><i style="mso-bidi-font-style:normal"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></i></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center;mso-layout-grid-align:
none;text-autospace:none"><i style="mso-bidi-font-style:normal"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">(This
Schedule will also reflect the Disbursement Schedule of Funds alongwith
milestones if any)<o:p></o:p></span></i></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 width="100%"
 style="width:100.0%;border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt">
 <tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;height:26.2pt">
  <td width="6%" valign=top style="width:6.48%;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Sr.
  No<o:p></o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.6%;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Activity<o:p></o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.12%;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Timeline<o:p></o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.32%;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Milestone
  for achievement<o:p></o:p></span></p>
  </td>
  <td width="14%" valign=top style="width:14.48%;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Budget
  (INR)<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:1;height:26.2pt">
  <td width="6%" valign=top style="width:6.48%;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.6%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.12%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.32%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="14%" valign=top style="width:14.48%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:2;height:26.2pt">
  <td width="6%" valign=top style="width:6.48%;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.6%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.12%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.32%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="14%" valign=top style="width:14.48%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:3;height:26.2pt">
  <td width="6%" valign=top style="width:6.48%;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.6%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.12%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.32%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="14%" valign=top style="width:14.48%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:4;height:26.2pt">
  <td width="6%" valign=top style="width:6.48%;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.6%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.12%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.32%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="14%" valign=top style="width:14.48%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:5;height:26.2pt">
  <td width="6%" valign=top style="width:6.48%;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.6%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.12%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.32%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="14%" valign=top style="width:14.48%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:6;height:26.2pt">
  <td width="6%" valign=top style="width:6.48%;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.6%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.12%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.32%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="14%" valign=top style="width:14.48%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:7;mso-yfti-lastrow:yes;height:26.2pt">
  <td width="6%" valign=top style="width:6.48%;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.6%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.12%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="26%" valign=top style="width:26.32%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="14%" valign=top style="width:14.48%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<b style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;
line-height:115%;font-family:DINPro-Regular;mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:Arial;mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA"><br clear=all style="mso-special-character:line-break;
page-break-before:always">
</span></b>

<p class=MsoNormal style="margin-bottom:10.0pt;line-height:115%"><b
style="mso-bidi-font-weight:normal"><span style="font-size:11.0pt;line-height:
115%;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center;mso-layout-grid-align:
none;text-autospace:none"><b style="mso-bidi-font-weight:normal"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Schedule
III<o:p></o:p></span></b></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center;mso-layout-grid-align:
none;text-autospace:none"><b style="mso-bidi-font-weight:normal"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Disbursement
Schedule:<o:p></o:p></span></b></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
none;text-autospace:none"><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
none;text-autospace:none"><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Payment to the Implementor will be made on their
name and address as provided by bank transfer, standing order or bank draft as
per the achievements of the milestones as detailed in Schedule II.<span
style="mso-spacerun:yes">  </span>First fund release will be transferred after
the signing of Agreement. Remaining payments will be done after operational and
fund utilization report submission of the preceeding installment.<o:p></o:p></span></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
none;text-autospace:none"><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width="100%"
 style="width:100.0%;border-collapse:collapse;mso-yfti-tbllook:1184;mso-padding-alt:
 0in 5.4pt 0in 5.4pt">
 <tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;height:14.75pt">
  <td width="9%" nowrap valign=bottom style="width:9.02%;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:14.75pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Sr.no<o:p></o:p></span></b></p>
  </td>
  <td width="58%" nowrap valign=bottom style="width:58.68%;border:solid windowtext 1.0pt;
  border-left:none;mso-border-top-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0in 5.4pt 0in 5.4pt;height:14.75pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Installments<o:p></o:p></span></b></p>
  </td>
  <td width="16%" nowrap valign=bottom style="width:16.16%;border:solid windowtext 1.0pt;
  border-left:none;mso-border-top-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0in 5.4pt 0in 5.4pt;height:14.75pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Percentage<o:p></o:p></span></b></p>
  </td>
  <td width="16%" valign=top style="width:16.14%;border:solid windowtext 1.0pt;
  border-left:none;mso-border-top-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0in 5.4pt 0in 5.4pt;height:14.75pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Agreement<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:1;height:23.6pt">
  <td width="9%" nowrap valign=bottom style="width:9.02%;border:solid windowtext 1.0pt;
  border-top:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0in 5.4pt 0in 5.4pt;height:23.6pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="58%" style="width:58.68%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:23.6pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Installment No. 1 (On signing of the Agreement)<o:p></o:p></span></p>
  </td>
  <td width="16%" nowrap style="width:16.16%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:23.6pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="16%" style="width:16.14%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:23.6pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:2;height:29.6pt">
  <td width="9%" nowrap valign=bottom style="width:9.02%;border:solid windowtext 1.0pt;
  border-top:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0in 5.4pt 0in 5.4pt;height:29.6pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="58%" style="width:58.68%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:29.6pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Installment No. 2<o:p></o:p></span></p>
  </td>
  <td width="16%" nowrap valign=top style="width:16.16%;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:29.6pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="16%" style="width:16.14%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:29.6pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:3;height:29.6pt">
  <td width="9%" nowrap valign=bottom style="width:9.02%;border:solid windowtext 1.0pt;
  border-top:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0in 5.4pt 0in 5.4pt;height:29.6pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="58%" style="width:58.68%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:29.6pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Installment No. 3<o:p></o:p></span></p>
  </td>
  <td width="16%" nowrap valign=top style="width:16.16%;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:29.6pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="16%" style="width:16.14%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:29.6pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:4;height:29.6pt">
  <td width="9%" nowrap valign=bottom style="width:9.02%;border:solid windowtext 1.0pt;
  border-top:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0in 5.4pt 0in 5.4pt;height:29.6pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="58%" style="width:58.68%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:29.6pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Installment No. 4<o:p></o:p></span></p>
  </td>
  <td width="16%" nowrap valign=top style="width:16.16%;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:29.6pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="16%" style="width:16.14%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:29.6pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:5;mso-yfti-lastrow:yes;height:14.75pt">
  <td width="9%" nowrap valign=bottom style="width:9.02%;border:solid windowtext 1.0pt;
  border-top:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0in 5.4pt 0in 5.4pt;height:14.75pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width="58%" nowrap style="width:58.68%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.75pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">TOTAL<o:p></o:p></span></b></p>
  </td>
  <td width="16%" nowrap style="width:16.16%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.75pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width="16%" style="width:16.14%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.75pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify;mso-layout-grid-align:
  none;text-autospace:none"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
</table>

<p class=MsoNormalCxSpLast style="text-align:justify;mso-layout-grid-align:
none;text-autospace:none"><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoListParagraphCxSpFirst style="text-align:justify;text-indent:-.25in;
mso-list:l11 level1 lfo8;mso-layout-grid-align:none;text-autospace:none"><![if !supportLists]><span
style="font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;
mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">a.<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial">Payment shall be
made in subsequent period to (Name of the organization) by THE CONTRIBUTOR on
the receipt of documents and compliance as under:<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify;text-indent:-.25in;mso-list:l11 level2 lfo8;mso-layout-grid-align:
none;text-autospace:none"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">a.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Certified copies of Receipts of salaries/honorarium
paid to coordinators/ trainers and vouchers of administrative / miscellaneous
costs made by ____________________________________.<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify;text-indent:-.25in;mso-list:l11 level2 lfo8;mso-layout-grid-align:
none;text-autospace:none"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">b.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">List of beneficiaries of the project implemented by
____________________________________.<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify;text-indent:-.25in;mso-list:l11 level2 lfo8;mso-layout-grid-align:
none;text-autospace:none"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">c.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Photographs of the interventions.<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify;text-indent:-.25in;mso-list:l11 level2 lfo8;mso-layout-grid-align:
none;text-autospace:none"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">d.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Certification by _________________________that
funds for the project has not been received from any other source.<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpLast style="margin-left:1.0in;mso-add-space:auto;
text-align:justify;text-indent:-.25in;mso-list:l11 level2 lfo8;mso-layout-grid-align:
none;text-autospace:none"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">e.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Any other documents evidencing the execution of the
projects as envisaged.<o:p></o:p></span></p>

<p class=MsoNormalCxSpFirst style="text-align:justify;mso-layout-grid-align:
none;text-autospace:none"><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormalCxSpLast style="text-align:justify;mso-layout-grid-align:
none;text-autospace:none"><b style="mso-bidi-font-weight:normal"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Verification:<o:p></o:p></span></b></p>

<p class=MsoListParagraphCxSpFirst style="text-align:justify;text-indent:-.25in;
mso-list:l14 level1 lfo7;mso-layout-grid-align:none;text-autospace:none"><![if !supportLists]><span
style="font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;
mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">1.<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial">_______________to
produce details of accounts, bills, etc. (wherever applicable)<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpLast style="text-align:justify;text-indent:-.25in;
mso-list:l14 level1 lfo7;mso-layout-grid-align:none;text-autospace:none"><![if !supportLists]><span
style="font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;
mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">2.<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial">_______________to
provide high resolution photographs of program<o:p></o:p></span></p>

<p class=MsoNormalCxSpFirst style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormalCxSpMiddle align=center style="text-align:center;mso-layout-grid-align:
none;text-autospace:none"><b style="mso-bidi-font-weight:normal"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Schedule
IV<o:p></o:p></span></b></p>

<p class=MsoNormalCxSpLast style="text-align:justify;mso-layout-grid-align:
none;text-autospace:none"><b style="mso-bidi-font-weight:normal"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>

<h1 style="text-indent:-.25in;mso-list:l3 level1 lfo6"><![if !supportLists]><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">A.<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><u><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">Periodical Project Progress Report<o:p></o:p></span></u></h1>

<div style="mso-element:para-border-div;border-top:solid #4F81BD 1.0pt;
mso-border-top-themecolor:accent1;border-left:none;border-bottom:solid #4F81BD 1.0pt;
mso-border-bottom-themecolor:accent1;border-right:none;mso-border-top-alt:solid #4F81BD .5pt;
mso-border-top-themecolor:accent1;mso-border-bottom-alt:solid #4F81BD .5pt;
mso-border-bottom-themecolor:accent1;padding:10.0pt 0in 10.0pt 0in;margin-left:
0in;margin-right:-1.8pt">

<p class=MsoIntenseQuote style="margin:0in;margin-bottom:.0001pt;mso-add-space:
auto;text-align:justify"><b style="mso-bidi-font-weight:normal"><span
lang=EN-IN style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial;color:windowtext"><span style="mso-spacerun:yes">               </span>Periodical
Project Progress Report<o:p></o:p></span></b></p>

</div>

<h2 style="margin-left:.25in;mso-add-space:auto;text-indent:-.25in;mso-list:
l9 level1 lfo5"><![if !supportLists]><b><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">1.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span></b><![endif]><b><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Project Details<o:p></o:p></span></b></h2>

<p class=MsoNormalCxSpFirst style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><i style="mso-bidi-font-style:
normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial;mso-bidi-font-weight:bold">INSTRUCTIONS: Complete the following table
with details of the project.<o:p></o:p></span></i></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<table class=CHECTable1 border=1 cellspacing=0 cellpadding=0 width="100%"
 style="width:100.0%;border-collapse:collapse;border:none;mso-border-alt:solid #7F7F7F 1.0pt;
 mso-border-themecolor:text1;mso-border-themetint:128;mso-yfti-tbllook:1184;
 mso-padding-alt:0in 5.4pt 0in 5.4pt">
 <tr style="mso-yfti-irow:-1;mso-yfti-firstrow:yes;mso-yfti-lastfirstrow:yes;
  height:19.05pt">
  <td width="21%" style="width:21.72%;border:solid #7F7F7F 1.0pt;mso-border-themecolor:
  text1;mso-border-themetint:128;background:#D9D9D9;mso-background-themecolor:
  background1;mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt;
  height:19.05pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify;mso-yfti-cnfc:1"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Name
  of the partner</span></b><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p></o:p></span></p>
  </td>
  <td width="78%" style="width:78.28%;border:solid #7F7F7F 1.0pt;mso-border-themecolor:
  text1;mso-border-themetint:128;border-left:none;mso-border-left-alt:solid #7F7F7F 1.0pt;
  mso-border-left-themecolor:text1;mso-border-left-themetint:128;padding:0in 5.4pt 0in 5.4pt;
  height:19.05pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify;mso-yfti-cnfc:1"><b><span style="font-size:11.0pt;
  font-family:DINPro-Regular;mso-bidi-font-family:Arial">&lt;Partners to insert
  the name of their organization&gt;</span></b><span style="font-size:11.0pt;
  font-family:DINPro-Regular;mso-bidi-font-family:Arial;mso-bidi-font-weight:
  bold"><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:0;height:10.45pt">
  <td width="21%" style="width:21.72%;border:solid #7F7F7F 1.0pt;mso-border-themecolor:
  text1;mso-border-themetint:128;border-top:none;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;background:#D9D9D9;
  mso-background-themecolor:background1;mso-background-themeshade:217;
  padding:0in 5.4pt 0in 5.4pt;height:10.45pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Sector<o:p></o:p></span></p>
  </td>
  <w:Sdt DocPart="BABD94E6FD18420B988C07701CB6BA87" DropDown="t" ID="1871024180"><w:ListItem
    ListValue="Choose a sector" DataValue="Choose a sector"></w:ListItem>
   <w:ListItem ListValue="Education" DataValue="Education"></w:ListItem>
   <w:ListItem ListValue="Environment Management"
    DataValue="Environment Management"></w:ListItem>
   <w:ListItem ListValue="Healthcare" DataValue="Healthcare"></w:ListItem>
   <w:ListItem ListValue="Livelihoods" DataValue="Livelihoods"></w:ListItem>
   <w:ListItem ListValue="Rural Management" DataValue="Rural Management"></w:ListItem>
   <td width="78%" style="width:78.28%;border-top:none;border-left:none;
   border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
   mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
   text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
   mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
   solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
   128;padding:0in 5.4pt 0in 5.4pt;height:10.45pt">
   <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
   text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
   mso-bidi-font-family:Arial;mso-bidi-font-weight:bold">&lt;Choose a sector&gt;&lt;Choose
   a sector&gt;<o:p></o:p><w:sdtPr></w:sdtPr></span></p>
   </td>
  </w:Sdt>
 </tr>
 <tr style="mso-yfti-irow:1;height:10.45pt">
  <td width="21%" style="width:21.72%;border:solid #7F7F7F 1.0pt;mso-border-themecolor:
  text1;mso-border-themetint:128;border-top:none;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;background:#D9D9D9;
  mso-background-themecolor:background1;mso-background-themeshade:217;
  padding:0in 5.4pt 0in 5.4pt;height:10.45pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Project name<b style="mso-bidi-font-weight:normal"><o:p></o:p></b></span></p>
  </td>
  <td width="78%" style="width:78.28%;border-top:none;border-left:none;
  border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt;height:10.45pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial;mso-bidi-font-weight:bold">&lt;Insert title of project&gt;<b><o:p></o:p></b></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:2;height:22.15pt">
  <td width="21%" style="width:21.72%;border:solid #7F7F7F 1.0pt;mso-border-themecolor:
  text1;mso-border-themetint:128;border-top:none;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;background:#D9D9D9;
  mso-background-themecolor:background1;mso-background-themeshade:217;
  padding:0in 5.4pt 0in 5.4pt;height:22.15pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Location<o:p></o:p></span></p>
  </td>
  <td width="78%" style="width:78.28%;border-top:none;border-left:none;
  border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt;height:22.15pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial;mso-bidi-font-weight:bold">&lt;Specify the state
  and district where the project was undertaken &gt;<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:3;height:36.2pt">
  <td width="21%" style="width:21.72%;border:solid #7F7F7F 1.0pt;mso-border-themecolor:
  text1;mso-border-themetint:128;border-top:none;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;background:#D9D9D9;
  mso-background-themecolor:background1;mso-background-themeshade:217;
  padding:0in 5.4pt 0in 5.4pt;height:36.2pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Reporting period<o:p></o:p></span></p>
  </td>
  <td width="78%" style="width:78.28%;border-top:none;border-left:none;
  border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt;height:36.2pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial;mso-bidi-font-weight:bold">&lt;Insert the period covered
  by the report <o:p></o:p></span></p>
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial;mso-bidi-font-weight:bold">(Please refer to
  quarter as the financial quarter and not project quarter)</span><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:4;height:10.9pt">
  <td width="21%" style="width:21.72%;border:solid #7F7F7F 1.0pt;mso-border-themecolor:
  text1;mso-border-themetint:128;border-top:none;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;background:#D9D9D9;
  mso-background-themecolor:background1;mso-background-themeshade:217;
  padding:0in 5.4pt 0in 5.4pt;height:10.9pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Report compiled by<o:p></o:p></span></p>
  </td>
  <td width="78%" style="width:78.28%;border-top:none;border-left:none;
  border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt;height:10.9pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial;mso-bidi-font-weight:bold">&lt;Insert the name and
  designation of the person who prepared this report&gt;</span><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:5;mso-yfti-lastrow:yes;height:19.05pt">
  <td width="21%" style="width:21.72%;border:solid #7F7F7F 1.0pt;mso-border-themecolor:
  text1;mso-border-themetint:128;border-top:none;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;background:#D9D9D9;
  mso-background-themecolor:background1;mso-background-themeshade:217;
  padding:0in 5.4pt 0in 5.4pt;height:19.05pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Date submitted<o:p></o:p></span></p>
  </td>
  <td width="78%" style="width:78.28%;border-top:none;border-left:none;
  border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt;height:19.05pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial;mso-bidi-font-weight:bold">&lt;Insert date&gt;<o:p></o:p></span></p>
  </td>
 </tr>
</table>

<h2 style="margin-left:0in;mso-add-space:auto;text-indent:0in;mso-list:none"><a
name="_Toc322274493"><span style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></a></h2>

<p class=MsoNormal><span style="mso-bookmark:_Toc322274493"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal><span style="mso-bookmark:_Toc322274493"><o:p>&nbsp;</o:p></span></p>

<h2 style="margin-left:.25in;mso-add-space:auto;text-indent:-.25in;mso-list:
l9 level1 lfo5"><span style="mso-bookmark:_Toc322274493"><![if !supportLists]><b><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">2.<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular">Summary of the
achievements of the quarter<o:p></o:p></span></b></span></h2>

<p class=MsoNormalCxSpFirst style="text-align:justify"><span style="mso-bookmark:
_Toc322274493"><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></span></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><span style="mso-bookmark:
_Toc322274493"><i style="mso-bidi-font-style:normal"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial;mso-bidi-font-weight:
bold">INSTRUCTIONS: Insert a one paragraph summary of progress and major
accomplishments (if any) during the reporting period. (Please be precise in the
detailing and use the below bullet points. If activities can be bucketed,
please do so appropriately)<o:p></o:p></span></i></span></p>

<p class=MsoNormalCxSpLast style="text-align:justify"><span style="mso-bookmark:
_Toc322274493"><b><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></span></p>

<p class=MsoListParagraphCxSpFirst style="text-align:justify;text-indent:-.25in;
mso-list:l4 level1 lfo9"><span style="mso-bookmark:_Toc322274493"><![if !supportLists]><span
lang=EN-AU style="font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;
mso-bidi-font-family:DINPro-Regular;mso-ansi-language:EN-AU;mso-bidi-font-weight:
bold"><span style="mso-list:Ignore">a.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=EN-AU style="font-family:DINPro-Regular;
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
mso-ansi-language:EN-AU;mso-bidi-font-weight:bold">&lt;Test&gt;<o:p></o:p></span></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l4 level1 lfo9"><span style="mso-bookmark:_Toc322274493"><![if !supportLists]><span
lang=EN-AU style="font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;
mso-bidi-font-family:DINPro-Regular;mso-ansi-language:EN-AU;mso-bidi-font-weight:
bold"><span style="mso-list:Ignore">b.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=EN-AU style="font-family:DINPro-Regular;
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
mso-ansi-language:EN-AU;mso-bidi-font-weight:bold">&lt;Test&gt;<o:p></o:p></span></span></p>

<p class=MsoListParagraphCxSpLast style="text-align:justify;text-indent:-.25in;
mso-list:l4 level1 lfo9"><span style="mso-bookmark:_Toc322274493"><![if !supportLists]><span
lang=EN-AU style="font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;
mso-bidi-font-family:DINPro-Regular;mso-ansi-language:EN-AU;mso-bidi-font-weight:
bold"><span style="mso-list:Ignore">c.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span lang=EN-AU style="font-family:DINPro-Regular;
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
mso-ansi-language:EN-AU;mso-bidi-font-weight:bold">&lt;Test&gt;<o:p></o:p></span></span></p>

<p class=MsoNormal style="text-align:justify"><span style="mso-bookmark:_Toc322274493"><b><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></span></p>

<span style="mso-bookmark:_Toc322274493"></span>

<h2 style="margin-left:.25in;mso-add-space:auto;text-indent:-.25in;mso-list:
l9 level1 lfo5"><![if !supportLists]><b><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">3.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span></b><![endif]><b><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Activities &amp; Outputs<o:p></o:p></span></b></h2>

<p class=MsoNormalCxSpFirst style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><i style="mso-bidi-font-style:
normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial;mso-bidi-font-weight:bold">INSTRUCTIONS: Complete the following table for
each activity in the project (see example below). Describe your progress with
the activity and the outputs generated. Choose a status for each activity
(achieved, in progress, challenges or not started). Please mention the activity
as per the approved milestones mentioned in the Agreement.<o:p></o:p></span></i></p>

<p class=MsoNormalCxSpLast style="text-align:justify"><b><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>

<h3 style="line-height:normal"><span style="font-family:DINPro-Regular">&lt;Activity
1&gt;<b><sup>1<o:p></o:p></sup></b></span></h3>

<p class=MsoNormalCxSpFirst style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<table class=CHECTable1 border=1 cellspacing=0 cellpadding=0 style="border-collapse:
 collapse;border:none;mso-border-alt:solid #7F7F7F 1.0pt;mso-border-themecolor:
 text1;mso-border-themetint:128;mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt">
 <tr style="mso-yfti-irow:-1;mso-yfti-firstrow:yes;mso-yfti-lastfirstrow:yes;
  page-break-inside:avoid">
  <td width=185 valign=top style="width:139.0pt;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;background:#D9D9D9;
  mso-background-themecolor:background1;mso-background-themeshade:217;
  padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify;mso-yfti-cnfc:1"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Status</span></b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p></o:p></span></p>
  </td>
  <td width=431 valign=top style="width:323.1pt;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;border-left:none;
  mso-border-left-alt:solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;
  mso-border-left-themetint:128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify;mso-yfti-cnfc:1"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><w:Sdt
   ShowingPlcHdr="t" DocPart="F8518BC387474325879A22011C8B95FD" DropDown="t"
   Title="Activity Status" SdtTag="Activity Status" ID="-2080976456"><w:ListItem
    ListValue="Choose the activity status"
    DataValue="Choose the activity status"></w:ListItem>
   <w:ListItem ListValue="Achieved " DataValue="Achieved "></w:ListItem>
   <w:ListItem ListValue="In Progress" DataValue="In Progress"></w:ListItem>
   <w:ListItem ListValue="Challenges" DataValue="Challenges"></w:ListItem>
   <w:ListItem ListValue="Not Started" DataValue="Not Started"></w:ListItem>
   <span class=MsoPlaceholderText><span style="mso-fareast-font-family:Calibri;
   mso-fareast-theme-font:minor-latin;color:windowtext">Choose an item.</span></span></w:Sdt></span></b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial;
  mso-bidi-font-weight:bold"><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:0;page-break-inside:avoid">
  <td width=185 valign=top style="width:139.0pt;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;border-top:none;
  mso-border-top-alt:solid #7F7F7F 1.0pt;mso-border-top-themecolor:text1;
  mso-border-top-themetint:128;background:#D9D9D9;mso-background-themecolor:
  background1;mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Objective<o:p></o:p></span></p>
  </td>
  <td width=431 valign=top style="width:323.1pt;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial;mso-bidi-font-weight:bold">&lt;Insert the
  objective of the activity&gt;<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:1;page-break-inside:avoid">
  <td width=185 valign=top style="width:139.0pt;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;border-top:none;
  mso-border-top-alt:solid #7F7F7F 1.0pt;mso-border-top-themecolor:text1;
  mso-border-top-themetint:128;background:#D9D9D9;mso-background-themecolor:
  background1;mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Milestone for achievement<o:p></o:p></span></p>
  </td>
  <td width=431 valign=top style="width:323.1pt;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial;mso-bidi-font-weight:bold">&lt;Insert the
  milestone for achievement as pre-approved&gt;<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:2;page-break-inside:avoid">
  <td width=185 valign=top style="width:139.0pt;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;border-top:none;
  mso-border-top-alt:solid #7F7F7F 1.0pt;mso-border-top-themecolor:text1;
  mso-border-top-themetint:128;background:#D9D9D9;mso-background-themecolor:
  background1;mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Progress<o:p></o:p></span></p>
  </td>
  <td width=431 valign=top style="width:323.1pt;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial;mso-bidi-font-weight:bold">&lt;Describe your
  progress with the activity&gt;</span><span style="font-size:11.0pt;
  font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:3;mso-yfti-lastrow:yes;page-break-inside:avoid">
  <td width=185 valign=top style="width:139.0pt;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;border-top:none;
  mso-border-top-alt:solid #7F7F7F 1.0pt;mso-border-top-themecolor:text1;
  mso-border-top-themetint:128;background:#D9D9D9;mso-background-themecolor:
  background1;mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Outputs created<o:p></o:p></span></p>
  </td>
  <td width=431 valign=top style="width:323.1pt;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial;mso-bidi-font-weight:bold">&lt;List the outputs
  that have been created from the activity&gt;</span><span style="font-size:
  11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p></o:p></span></p>
  </td>
 </tr>
</table>

<h3 style="line-height:normal"><span style="font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h3>

<p class=MsoNormal style="text-align:justify"><sup><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">1</span></sup><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Please
replicate as required<o:p></o:p></span></p>

<h2 style="margin-left:.25in;mso-add-space:auto;text-indent:-.25in;mso-list:
l9 level1 lfo5"><![if !supportLists]><b><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:
DINPro-Regular"><span style="mso-list:Ignore">4.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span></b><![endif]><b><span style="mso-bidi-font-size:11.0pt;
font-family:DINPro-Regular">Impact<o:p></o:p></span></b></h2>

<p class=MsoNormalCxSpFirst style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><i style="mso-bidi-font-style:
normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial;mso-bidi-font-weight:bold">INSTRUCTIONS: Complete the following table
with the latest results for your key indicators. Focus on outcome / goal
indicators if possible, rather than activities and outputs which are already
described in the previous section. Choose a status for each indicator
(achieved, in progress, challenges or not started).<o:p></o:p></span></i></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><b><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>

<table class=CHECTable2 border=1 cellspacing=0 cellpadding=0 width="100%"
 style="width:100.0%;border-collapse:collapse;border:none;mso-border-alt:solid #7F7F7F 1.0pt;
 mso-border-themecolor:text1;mso-border-themetint:128;mso-yfti-tbllook:1184;
 mso-padding-alt:0in 5.4pt 0in 5.4pt">
 <thead>
  <tr style="mso-yfti-irow:-1;mso-yfti-firstrow:yes;mso-yfti-lastfirstrow:yes">
   <td width="45%" valign=top style="width:45.1%;border:solid #7F7F7F 1.0pt;
   mso-border-themecolor:text1;mso-border-themetint:128;background:#BFBFBF;
   mso-background-themecolor:background1;mso-background-themeshade:191;
   padding:0in 5.4pt 0in 5.4pt">
   <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
   text-align:justify;mso-yfti-cnfc:1"><b style="mso-bidi-font-weight:normal"><span
   style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
   Arial">Indicator<o:p></o:p></span></b></p>
   </td>
   <td width="14%" valign=top style="width:14.12%;border:solid #7F7F7F 1.0pt;
   mso-border-themecolor:text1;mso-border-themetint:128;border-left:none;
   mso-border-left-alt:solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;
   mso-border-left-themetint:128;background:#BFBFBF;mso-background-themecolor:
   background1;mso-background-themeshade:191;padding:0in 5.4pt 0in 5.4pt">
   <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
   text-align:justify;mso-yfti-cnfc:1"><b style="mso-bidi-font-weight:normal"><span
   style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
   Arial">Baseline<o:p></o:p></span></b></p>
   </td>
   <td width="12%" valign=top style="width:12.54%;border:solid #7F7F7F 1.0pt;
   mso-border-themecolor:text1;mso-border-themetint:128;border-left:none;
   mso-border-left-alt:solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;
   mso-border-left-themetint:128;background:#BFBFBF;mso-background-themecolor:
   background1;mso-background-themeshade:191;padding:0in 5.4pt 0in 5.4pt">
   <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
   text-align:justify;mso-yfti-cnfc:1"><b style="mso-bidi-font-weight:normal"><span
   style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
   Arial">Target<o:p></o:p></span></b></p>
   </td>
   <td width="12%" valign=top style="width:12.54%;border:solid #7F7F7F 1.0pt;
   mso-border-themecolor:text1;mso-border-themetint:128;border-left:none;
   mso-border-left-alt:solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;
   mso-border-left-themetint:128;background:#BFBFBF;mso-background-themecolor:
   background1;mso-background-themeshade:191;padding:0in 5.4pt 0in 5.4pt">
   <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
   text-align:justify;mso-yfti-cnfc:1"><b style="mso-bidi-font-weight:normal"><span
   style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
   Arial">Result as of &lt;date&gt;<o:p></o:p></span></b></p>
   </td>
   <td width="15%" valign=top style="width:15.68%;border:solid #7F7F7F 1.0pt;
   mso-border-themecolor:text1;mso-border-themetint:128;border-left:none;
   mso-border-left-alt:solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;
   mso-border-left-themetint:128;background:#BFBFBF;mso-background-themecolor:
   background1;mso-background-themeshade:191;padding:0in 5.4pt 0in 5.4pt">
   <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
   text-align:justify;mso-yfti-cnfc:1"><b style="mso-bidi-font-weight:normal"><span
   style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
   Arial">Status<o:p></o:p></span></b></p>
   </td>
  </tr>
 </thead>
 <tr style="mso-yfti-irow:0">
  <td width="45%" valign=top style="width:45.1%;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;border-top:none;
  mso-border-top-alt:solid #7F7F7F 1.0pt;mso-border-top-themecolor:text1;
  mso-border-top-themetint:128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><i style="mso-bidi-font-style:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">[EXAMPLE]
  Percentage of tribal actually attending the sessions<o:p></o:p></span></i></p>
  </td>
  <td width="14%" valign=top style="width:14.12%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><i style="mso-bidi-font-style:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">23%<o:p></o:p></span></i></p>
  </td>
  <td width="12%" valign=top style="width:12.54%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><i style="mso-bidi-font-style:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">95%<o:p></o:p></span></i></p>
  </td>
  <td width="12%" valign=top style="width:12.54%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><i style="mso-bidi-font-style:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">55%<o:p></o:p></span></i></p>
  </td>
  <td width="15%" valign=top style="width:15.68%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">In progress<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:1">
  <td width="45%" valign=top style="width:45.1%;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;border-top:none;
  mso-border-top-alt:solid #7F7F7F 1.0pt;mso-border-top-themecolor:text1;
  mso-border-top-themetint:128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="14%" valign=top style="width:14.12%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="12%" valign=top style="width:12.54%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="12%" valign=top style="width:12.54%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="15%" valign=top style="width:15.68%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Achieved<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:2">
  <td width="45%" valign=top style="width:45.1%;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;border-top:none;
  mso-border-top-alt:solid #7F7F7F 1.0pt;mso-border-top-themecolor:text1;
  mso-border-top-themetint:128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="14%" valign=top style="width:14.12%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="12%" valign=top style="width:12.54%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="12%" valign=top style="width:12.54%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="15%" valign=top style="width:15.68%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">In progress<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:3">
  <td width="45%" valign=top style="width:45.1%;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;border-top:none;
  mso-border-top-alt:solid #7F7F7F 1.0pt;mso-border-top-themecolor:text1;
  mso-border-top-themetint:128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="14%" valign=top style="width:14.12%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="12%" valign=top style="width:12.54%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="12%" valign=top style="width:12.54%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="15%" valign=top style="width:15.68%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Challenges<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:4">
  <td width="45%" valign=top style="width:45.1%;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;border-top:none;
  mso-border-top-alt:solid #7F7F7F 1.0pt;mso-border-top-themecolor:text1;
  mso-border-top-themetint:128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="14%" valign=top style="width:14.12%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="12%" valign=top style="width:12.54%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="12%" valign=top style="width:12.54%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="15%" valign=top style="width:15.68%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Not started<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:5;mso-yfti-lastrow:yes">
  <td width="45%" valign=top style="width:45.1%;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;border-top:none;
  mso-border-top-alt:solid #7F7F7F 1.0pt;mso-border-top-themecolor:text1;
  mso-border-top-themetint:128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="14%" valign=top style="width:14.12%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="12%" valign=top style="width:12.54%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="12%" valign=top style="width:12.54%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="15%" valign=top style="width:15.68%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
</table>

<h2 style="mso-list:none;tab-stops:321.75pt"><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h2 style="margin-left:.25in;mso-add-space:auto;text-indent:-.25in;mso-list:
l9 level1 lfo5;tab-stops:321.75pt"><![if !supportLists]><b><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">5.<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular">Engagement with
partners &amp; stakeholders<o:p></o:p></span></b></h2>

<h2 style="mso-list:none;tab-stops:321.75pt"><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular"><span style="mso-tab-count:1">                </span><o:p></o:p></span></h2>

<p class=MsoNormalCxSpFirst style="text-align:justify"><i style="mso-bidi-font-style:
normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial;mso-bidi-font-weight:bold">INSTRUCTIONS: </span></i><i style="mso-bidi-font-style:
normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">The following table summarizes organization’s relationship with key
partners and stakeholders involved/associated in the project during the
reporting period:<o:p></o:p></span></i></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<table class=CHECTable2 border=1 cellspacing=0 cellpadding=0 width="100%"
 style="width:100.0%;border-collapse:collapse;border:none;mso-border-alt:solid #7F7F7F 1.0pt;
 mso-border-themecolor:text1;mso-border-themetint:128;mso-yfti-tbllook:1184;
 mso-padding-alt:0in 5.4pt 0in 5.4pt">
 <tr style="mso-yfti-irow:-1;mso-yfti-firstrow:yes;mso-yfti-lastfirstrow:yes">
  <td width="27%" valign=top style="width:27.22%;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;background:#BFBFBF;
  mso-background-themecolor:background1;mso-background-themeshade:191;
  padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify;mso-yfti-cnfc:1"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Partner
  / Stakeholder<o:p></o:p></span></b></p>
  </td>
  <td width="72%" valign=top style="width:72.78%;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;border-left:none;
  mso-border-left-alt:solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;
  mso-border-left-themetint:128;background:#BFBFBF;mso-background-themecolor:
  background1;mso-background-themeshade:191;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify;mso-yfti-cnfc:1"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Relationship
  update<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:0;mso-yfti-lastrow:yes">
  <td width="27%" valign=top style="width:27.22%;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;border-top:none;
  mso-border-top-alt:solid #7F7F7F 1.0pt;mso-border-top-themecolor:text1;
  mso-border-top-themetint:128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><i style="mso-bidi-font-style:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></i></p>
  </td>
  <td width="72%" valign=top style="width:72.78%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><i style="mso-bidi-font-style:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></i></p>
  </td>
 </tr>
</table>

<h2 style="mso-list:none;tab-stops:321.75pt"><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h2 style="margin-left:.25in;mso-add-space:auto;text-indent:-.25in;mso-list:
l9 level1 lfo5;tab-stops:321.75pt"><![if !supportLists]><b><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">6.<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular">Stakeholder
Participation &amp; Feedback<o:p></o:p></span></b></h2>

<p class=MsoNormalCxSpFirst style="margin-right:1.15pt;mso-add-space:auto;
text-align:justify;mso-layout-grid-align:none;text-autospace:none"><i
style="mso-bidi-font-style:normal"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial">Stakeholder participation: Please
describe how key stakeholders, <b style="mso-bidi-font-weight:normal">particularly
local beneficiaries</b>, have been involved in the project, (which can include
project/program design, implementation, monitoring, evaluation, and reporting. <b
style="mso-bidi-font-weight:normal">Do not include partnership issues, which is
covered in the above section.<o:p></o:p></b></span></i></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><i style="mso-bidi-font-style:
normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial"><o:p>&nbsp;</o:p></span></i></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><i style="mso-bidi-font-style:
normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">Stakeholder feedback: Using the table below, summarize any key
stakeholder feedback, be sure to explain how it will be handled in the
Recommended Follow-Up column. If there is no feedback, then leave blank. Be
sure to update any pending action from previous feedback.<o:p></o:p></span></i></p>

<p class=MsoNormalCxSpMiddle style="margin-right:1.15pt;mso-add-space:auto;
text-align:justify"><i style="mso-bidi-font-style:normal"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></i></p>

<div align=center>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width="100%"
 style="width:100.0%;border-collapse:collapse;border:none;mso-border-alt:solid black 2.25pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt;mso-border-insideh:
 1.0pt solid black;mso-border-insidev:1.0pt solid black">
 <tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;height:7.85pt">
  <td width="100%" colspan=5 valign=top style="width:100.0%;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;background:#E5E5E5;mso-shading:windowtext;
  mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;height:7.85pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial">Stakeholder Feedback Summary<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:1;height:26.8pt">
  <td width="36%" style="width:36.44%;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#E5E5E5;mso-shading:windowtext;mso-pattern:gray-10 auto;
  padding:0in 5.4pt 0in 5.4pt;height:26.8pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Feedback<o:p></o:p></span></b></p>
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><b><i
  style="mso-bidi-font-style:normal"><span style="font-size:11.0pt;font-family:
  DINPro-Regular;mso-bidi-font-family:Arial">(Clearly indicate whether it is a
  complaint or positive feedback)</span></i></b><i style="mso-bidi-font-style:
  normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
  Arial;mso-bidi-font-weight:bold"><o:p></o:p></span></i></p>
  </td>
  <td width="8%" style="width:8.84%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#E5E5E5;mso-shading:windowtext;
  mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;height:26.8pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial">Date<o:p></o:p></span></b></p>
  </td>
  <td width="10%" style="width:10.66%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#E5E5E5;mso-shading:windowtext;
  mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;height:26.8pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial">Priority<o:p></o:p></span></b></p>
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><b style="mso-bidi-font-weight:
  normal"><u><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-fareast-font-family:Calibri;mso-bidi-font-family:Arial">H</span></u></b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial">igh, <o:p></o:p></span></p>
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><b style="mso-bidi-font-weight:
  normal"><u><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-fareast-font-family:Calibri;mso-bidi-font-family:Arial">M</span></u></b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial">edium, <b style="mso-bidi-font-weight:
  normal"><u>L</u></b>ow<o:p></o:p></span></p>
  </td>
  <td width="31%" style="width:31.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#E5E5E5;mso-shading:windowtext;
  mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;height:26.8pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><b style="mso-bidi-font-weight:
  normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial">Recommended Follow-Up<o:p></o:p></span></b></p>
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial">(Write “NA” if not applicable. If
  applicable, explain what, who, and when the follow-up will occur)<b
  style="mso-bidi-font-weight:normal"><o:p></o:p></b></span></p>
  </td>
  <td width="12%" style="width:12.52%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#E5E5E5;mso-shading:windowtext;
  mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;height:26.8pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><b style="mso-bidi-font-weight:
  normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial">Closure Date<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:2;height:7.85pt">
  <td width="36%" valign=top style="width:36.44%;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:7.85pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial">1.<o:p></o:p></span></p>
  </td>
  <td width="8%" valign=top style="width:8.84%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:7.85pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial;mso-bidi-font-weight:bold"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="10%" valign=top style="width:10.66%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:7.85pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial;mso-bidi-font-weight:bold"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="31%" valign=top style="width:31.56%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:7.85pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="12%" valign=top style="width:12.52%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:7.85pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:3;height:7.85pt">
  <td width="36%" valign=top style="width:36.44%;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:7.85pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial">2.<o:p></o:p></span></p>
  </td>
  <td width="8%" valign=top style="width:8.84%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:7.85pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial;mso-bidi-font-weight:bold"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="10%" valign=top style="width:10.66%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:7.85pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial;mso-bidi-font-weight:bold"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="31%" valign=top style="width:31.56%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:7.85pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="12%" valign=top style="width:12.52%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:7.85pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:4;mso-yfti-lastrow:yes;height:8.2pt">
  <td width="36%" valign=top style="width:36.44%;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:8.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><i style="mso-bidi-font-style:
  normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial">Add rows as needed….<o:p></o:p></span></i></p>
  </td>
  <td width="8%" valign=top style="width:8.84%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:8.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="10%" valign=top style="width:10.66%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:8.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="31%" valign=top style="width:31.56%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:8.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="12%" valign=top style="width:12.52%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:8.2pt">
  <p class=MsoNormalCxSpMiddle style="text-align:justify"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
  Calibri;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
</table>

</div>

<h2 style="mso-list:none;tab-stops:321.75pt"><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h2 style="margin-left:.25in;mso-add-space:auto;text-indent:-.25in;mso-list:
l9 level1 lfo5;tab-stops:321.75pt"><![if !supportLists]><b><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">7.<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular">Program Visibility<o:p></o:p></span></b></h2>

<p class=MsoNormalCxSpFirst style="text-align:justify"><i style="mso-bidi-font-style:
normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial;mso-bidi-font-weight:bold">INSTRUCTIONS: </span></i><i style="mso-bidi-font-style:
normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">Please indicate how visibility was generated for this program. Please
list down all the activities undertaken to create visibility of the program.
Please do mention any such activities which are also a part of the regular
program implementation model<o:p></o:p></span></i></p>

<p class=MsoNormalCxSpLast style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<h2 style="margin-left:.25in;mso-add-space:auto;text-indent:-.25in;mso-list:
l9 level1 lfo5;tab-stops:321.75pt"><![if !supportLists]><b><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">8.<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular">Challenges faced
and lessons learnt <o:p></o:p></span></b></h2>

<h2 style="mso-list:none;tab-stops:321.75pt"><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular"><span style="mso-tab-count:1">                </span><o:p></o:p></span></h2>

<p class=MsoNormalCxSpFirst style="text-align:justify"><i style="mso-bidi-font-style:
normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial;mso-bidi-font-weight:bold">INSTRUCTIONS: Complete the table below with
challenges that were encountered during the reporting period and the lessons
learned. Include any solution that you plan to implement in the next reporting
cycle. <o:p></o:p></span></i></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><b><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>

<table class=CHECTable2 border=1 cellspacing=0 cellpadding=0 width="100%"
 style="width:100.0%;border-collapse:collapse;border:none;mso-border-alt:solid #7F7F7F 1.0pt;
 mso-border-themecolor:text1;mso-border-themetint:128;mso-yfti-tbllook:1184;
 mso-padding-alt:0in 5.4pt 0in 5.4pt">
 <tr style="mso-yfti-irow:-1;mso-yfti-firstrow:yes;mso-yfti-lastfirstrow:yes">
  <td width="30%" valign=top style="width:30.78%;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;background:#BFBFBF;
  mso-background-themecolor:background1;mso-background-themeshade:191;
  padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify;mso-yfti-cnfc:1"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Challenge<o:p></o:p></span></b></p>
  </td>
  <td width="69%" valign=top style="width:69.22%;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;border-left:none;
  mso-border-left-alt:solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;
  mso-border-left-themetint:128;background:#BFBFBF;mso-background-themecolor:
  background1;mso-background-themeshade:191;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify;mso-yfti-cnfc:1"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Lessons
  learnt / solutions devised<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:0">
  <td width="30%" valign=top style="width:30.78%;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;border-top:none;
  mso-border-top-alt:solid #7F7F7F 1.0pt;mso-border-top-themecolor:text1;
  mso-border-top-themetint:128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="69%" valign=top style="width:69.22%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:1">
  <td width="30%" valign=top style="width:30.78%;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;border-top:none;
  mso-border-top-alt:solid #7F7F7F 1.0pt;mso-border-top-themecolor:text1;
  mso-border-top-themetint:128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="69%" valign=top style="width:69.22%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:2">
  <td width="30%" valign=top style="width:30.78%;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;border-top:none;
  mso-border-top-alt:solid #7F7F7F 1.0pt;mso-border-top-themecolor:text1;
  mso-border-top-themetint:128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="69%" valign=top style="width:69.22%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:3;mso-yfti-lastrow:yes">
  <td width="30%" valign=top style="width:30.78%;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;border-top:none;
  mso-border-top-alt:solid #7F7F7F 1.0pt;mso-border-top-themecolor:text1;
  mso-border-top-themetint:128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="69%" valign=top style="width:69.22%;border-top:none;border-left:
  none;border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
</table>

<h2 style="mso-list:none;tab-stops:321.75pt"><span style="mso-bidi-font-size:
11.0pt;font-family:DINPro-Regular"><o:p>&nbsp;</o:p></span></h2>

<h2 style="margin-left:.25in;mso-add-space:auto;text-indent:-.25in;mso-list:
l9 level1 lfo5;tab-stops:321.75pt"><![if !supportLists]><b><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">9.<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular">Budget<o:p></o:p></span></b></h2>

<p class=MsoNormalCxSpFirst style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><i style="mso-bidi-font-style:
normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial;mso-bidi-font-weight:bold">INSTRUCTIONS: Provide a summary of the
expenditure during the reporting period compared to the original budget and
expenditure to-date. Explain any discrepancies or changes to the budget.<o:p></o:p></span></i></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><i style="mso-bidi-font-style:
normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial;mso-bidi-font-weight:bold"><o:p>&nbsp;</o:p></span></i></p>

<div align=center>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width="100%"
 style="width:100.0%;border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:480;mso-padding-alt:0in 5.4pt 0in 5.4pt;mso-border-insideh:
 .5pt solid windowtext;mso-border-insidev:.5pt solid windowtext">
 <tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;height:18.1pt">
  <td width="100%" colspan=6 valign=top style="width:100.0%;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;background:#E5E5E5;mso-shading:white;
  mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;height:18.1pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:-5.4pt;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Project Quarterly Fund Utilization<span
  style="mso-bidi-font-weight:bold"><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:1;height:18.1pt">
  <td width="16%" style="width:16.44%;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#E5E5E5;mso-shading:white;mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;
  height:18.1pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><b><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Q1/Q2/Q3/Q4 Budget Allocated (</span></b><b><span
  style="font-size:11.0pt;font-family:"Courier New"">&#8377;</span></b><b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">)<u>
  <o:p></o:p></u></span></b></p>
  </td>
  <td width="21%" style="width:21.42%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#E5E5E5;mso-shading:white;
  mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;height:18.1pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><b><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Q1/Q2/Q3/Q4 Budget Utilization (</span></b><b><span
  style="font-size:11.0pt;font-family:"Courier New"">&#8377;</span></b><b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">)<o:p></o:p></span></b></p>
  </td>
  <td width="9%" style="width:9.06%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#E5E5E5;mso-shading:white;
  mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;height:18.1pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:-5.4pt;mso-add-space:auto;
  text-align:justify"><b><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">% of budget utilized<o:p></o:p></span></b></p>
  </td>
  <td width="21%" style="width:21.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#E5E5E5;mso-shading:white;
  mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;height:18.1pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><b><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Funds Underspent/<o:p></o:p></span></b></p>
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><b><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Overspent if any<sup>2</sup><o:p></o:p></span></b></p>
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><b><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">(</span></b><b><span style="font-size:11.0pt;
  font-family:"Courier New"">&#8377;</span></b><b><span style="font-size:11.0pt;
  font-family:DINPro-Regular;mso-bidi-font-family:Arial">)<o:p></o:p></span></b></p>
  </td>
  <td width="19%" style="width:19.9%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#E5E5E5;mso-shading:white;
  mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;height:18.1pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><b><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Annual Budget<o:p></o:p></span></b></p>
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><b><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">(</span></b><b><span style="font-size:11.0pt;
  font-family:"Courier New"">&#8377;</span></b><b><span style="font-size:11.0pt;
  font-family:DINPro-Regular;mso-bidi-font-family:Arial">)<o:p></o:p></span></b></p>
  </td>
  <td width="11%" style="width:11.28%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#E5E5E5;mso-shading:white;
  mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;height:18.1pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:-5.4pt;mso-add-space:auto;
  text-align:justify"><b><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">% of budget utilized (</span></b><b><span
  style="font-size:11.0pt;font-family:"Courier New"">&#8377;</span></b><b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">)<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:2;mso-yfti-lastrow:yes;height:27.05pt">
  <td width="16%" valign=top style="width:16.44%;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:27.05pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="21%" valign=top style="width:21.42%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:27.05pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="9%" valign=top style="width:9.06%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:27.05pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="21%" valign=top style="width:21.88%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:27.05pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="19%" valign=top style="width:19.9%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:27.05pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="11%" valign=top style="width:11.28%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:27.05pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
</table>

</div>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><i style="mso-bidi-font-style:
normal"><sup><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">2</span></sup></i><i style="mso-bidi-font-style:
normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial">In case of underspend/overspend, please state the reason behind the
same. Please mark N/A if not applicable.<o:p></o:p></span></i></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><i style="mso-bidi-font-style:
normal"><span style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial;mso-bidi-font-weight:bold"><o:p>&nbsp;</o:p></span></i></p>

<table class=CHECTable2 border=1 cellspacing=0 cellpadding=0 width="100%"
 style="width:100.0%;border-collapse:collapse;border:none;mso-border-alt:solid #7F7F7F 1.0pt;
 mso-border-themecolor:text1;mso-border-themetint:128;mso-yfti-tbllook:1184;
 mso-padding-alt:0in 5.4pt 0in 5.4pt">
 <tr style="mso-yfti-irow:-1;mso-yfti-firstrow:yes;mso-yfti-lastfirstrow:yes;
  height:11.35pt">
  <td width="29%" rowspan=2 style="width:29.5%;border:solid #7F7F7F 1.0pt;
  mso-border-themecolor:text1;mso-border-themetint:128;background:#BFBFBF;
  mso-background-themecolor:background1;mso-background-themeshade:191;
  padding:0in 5.4pt 0in 5.4pt;height:11.35pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify;mso-yfti-cnfc:1"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Underspend/Overspend<o:p></o:p></span></b></p>
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify;mso-yfti-cnfc:1"><b style="mso-bidi-font-weight:normal"><i
  style="mso-bidi-font-style:normal"><span style="font-size:11.0pt;font-family:
  DINPro-Regular;mso-bidi-font-family:Arial">(please specify)<o:p></o:p></span></i></b></p>
  </td>
  <td width="70%" style="width:70.5%;border:solid #7F7F7F 1.0pt;mso-border-themecolor:
  text1;mso-border-themetint:128;border-left:none;mso-border-left-alt:solid #7F7F7F 1.0pt;
  mso-border-left-themecolor:text1;mso-border-left-themetint:128;background:
  #BFBFBF;mso-background-themecolor:background1;mso-background-themeshade:191;
  padding:0in 5.4pt 0in 5.4pt;height:11.35pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify;mso-yfti-cnfc:1"><b style="mso-bidi-font-weight:normal"><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Details<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:0;mso-yfti-lastrow:yes;height:47.05pt">
  <td width="70%" style="width:70.5%;border-top:none;border-left:none;
  border-bottom:solid #7F7F7F 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-themetint:128;border-right:solid #7F7F7F 1.0pt;mso-border-right-themecolor:
  text1;mso-border-right-themetint:128;mso-border-top-alt:solid #7F7F7F 1.0pt;
  mso-border-top-themecolor:text1;mso-border-top-themetint:128;mso-border-left-alt:
  solid #7F7F7F 1.0pt;mso-border-left-themecolor:text1;mso-border-left-themetint:
  128;padding:0in 5.4pt 0in 5.4pt;height:47.05pt">
  <p class=MsoNormalCxSpMiddle style="margin-top:3.0pt;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormalCxSpMiddle style="margin-top:3.0pt;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  <p class=MsoNormalCxSpMiddle style="margin-top:0in;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<div align=center>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width="100%"
 style="width:100.0%;border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:480;mso-padding-alt:0in 5.4pt 0in 5.4pt;mso-border-insideh:
 .5pt solid windowtext;mso-border-insidev:.5pt solid windowtext">
 <tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;height:18.75pt">
  <td width="100%" colspan=7 valign=top style="width:100.0%;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;background:#E5E5E5;mso-shading:white;
  mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;height:18.75pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:-5.4pt;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">Project Fund Utilization Till Date<span
  style="mso-bidi-font-weight:bold"><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:1;height:18.75pt">
  <td width="20%" style="width:20.12%;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  background:#E5E5E5;mso-shading:white;mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;
  height:18.75pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto"><b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">FY
  xxxx-xxxx (</span></b><b><span style="font-size:11.0pt;font-family:"Courier New"">&#8377;</span></b><b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">)<o:p></o:p></span></b></p>
  </td>
  <td width="20%" style="width:20.18%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#E5E5E5;mso-shading:white;
  mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;height:18.75pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto"><b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">YTD<sup>3</sup><span
  style="mso-spacerun:yes">  </span>expenses (</span></b><b><span
  style="font-size:11.0pt;font-family:"Courier New"">&#8377;</span></b><b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">)<o:p></o:p></span></b></p>
  </td>
  <td width="11%" style="width:11.92%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#E5E5E5;mso-shading:white;
  mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;height:18.75pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:-5.4pt;mso-add-space:auto"><b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">%
  of budget<o:p></o:p></span></b></p>
  </td>
  <td width="2%" valign=top style="width:2.76%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#E5E5E5;mso-shading:white;
  mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;height:18.75pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto"><b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width="18%" style="width:18.34%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#E5E5E5;mso-shading:white;
  mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;height:18.75pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto"><b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Total
  Program<o:p></o:p></span></b></p>
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto"><b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Budget
  (</span></b><b><span style="font-size:11.0pt;font-family:"Courier New"">&#8377;</span></b><b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">)<o:p></o:p></span></b></p>
  </td>
  <td width="18%" style="width:18.34%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#E5E5E5;mso-shading:white;
  mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;height:18.75pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto"><b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Total
  Expenditure (</span></b><b><span style="font-size:11.0pt;font-family:"Courier New"">&#8377;</span></b><b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">)<o:p></o:p></span></b></p>
  </td>
  <td width="8%" style="width:8.36%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;background:#E5E5E5;mso-shading:white;
  mso-pattern:gray-10 auto;padding:0in 5.4pt 0in 5.4pt;height:18.75pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:-5.4pt;mso-add-space:auto"><b><span
  style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">%
  of budget <o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:2;mso-yfti-lastrow:yes;height:27.95pt">
  <td width="20%" style="width:20.12%;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:27.95pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial">XX/Month/XXXX<o:p></o:p></span></p>
  </td>
  <td width="20%" style="width:20.18%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:27.95pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="11%" style="width:11.92%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:27.95pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="2%" valign=top style="width:2.76%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:27.95pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="18%" style="width:18.34%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:27.95pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="18%" style="width:18.34%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:27.95pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width="8%" style="width:8.36%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:27.95pt">
  <p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
  text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
  mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
</table>

</div>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><sup><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">3</span></sup><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Year
to date. This will be updated every quarter<o:p></o:p></span></p>

<p class=MsoNormalCxSpLast style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<h2 style="text-indent:-.25in;mso-list:l9 level1 lfo5;tab-stops:321.75pt"><![if !supportLists]><b><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular;mso-fareast-font-family:
DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">10.<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp; </span></span></span></b><![endif]><b><span
style="mso-bidi-font-size:11.0pt;font-family:DINPro-Regular">Report Annex <o:p></o:p></span></b></h2>

<p class=MsoListParagraphCxSpFirst style="text-align:justify;text-indent:-.25in;
mso-list:l12 level1 lfo4"><![if !supportLists]><span style="font-family:Symbol;
mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol"><span
style="mso-list:Ignore">·<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Quarterly statement of accounts/expenditure<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l12 level1 lfo4"><![if !supportLists]><span style="font-family:Symbol;
mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol"><span
style="mso-list:Ignore">·<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><b style="mso-bidi-font-weight:normal"><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial">TORs</span></b><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial"> (terms of
reference) for any key assignments, such as technical assistance, an
evaluation, a baseline survey, etc. (if applicable)<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-top:0in;margin-right:1.0pt;
margin-bottom:0in;margin-left:35.7pt;margin-bottom:.0001pt;mso-add-space:auto;
text-align:justify;text-indent:-17.85pt;mso-list:l8 level1 lfo3"><![if !supportLists]><span
style="font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:
Symbol"><span style="mso-list:Ignore">·<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><b style="mso-bidi-font-weight:normal"><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial">Case Study</span></b><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial"> – if possible, a
case study can be useful information for future assessment. A case study is a
detailed descriptive narrative of individuals, communities, or events
illustrating how the project/program is having an effect locally, what that
effect is and if it is in line with intended results. The case study can be
supplemented with photos, (sent separately). <o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-top:0in;margin-right:1.0pt;
margin-bottom:0in;margin-left:35.7pt;margin-bottom:.0001pt;mso-add-space:auto;
text-align:justify;text-indent:-17.85pt;mso-list:l8 level1 lfo3"><![if !supportLists]><span
style="font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:
Symbol"><span style="mso-list:Ignore">·<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><b style="mso-bidi-font-weight:normal"><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial">Project
Photographs </span></b><span style="font-family:DINPro-Regular;mso-bidi-font-family:
Arial">- Relevant photographs<sup>4</sup>, letters, commissioned studies,
reports, etc.<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpLast style="margin-top:0in;margin-right:1.0pt;
margin-bottom:0in;margin-left:35.7pt;margin-bottom:.0001pt;mso-add-space:auto;
text-align:justify"><span style="font-family:DINPro-Regular;mso-bidi-font-family:
Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormalCxSpFirst style="margin-right:1.0pt;mso-add-space:auto;
text-align:justify"><u><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">By checking this box, I certify that:<o:p></o:p></span></u></p>

<p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial"><w:Sdt CheckBox="t" CheckBoxIsChecked="f"
 CheckBoxValueChecked="&#9746;" CheckBoxValueUnchecked="&#9744;"
 CheckBoxFontChecked="MS Gothic" CheckBoxFontUnchecked="MS Gothic"
 ID="1718624862"><span style="font-family:"Segoe UI Symbol",sans-serif;
 mso-fareast-font-family:"MS Gothic";mso-bidi-font-family:"Segoe UI Symbol"">&#9744;</span></w:Sdt><span
style="mso-tab-count:1">            </span>All expenditures have been only made
in support of the stated purpose of the grant.<o:p></o:p></span></p>

<p class=MsoNormalCxSpMiddle style="margin-top:0in;margin-right:1.0pt;
margin-bottom:0in;margin-left:.5in;margin-bottom:.0001pt;mso-add-space:auto;
text-align:justify;text-indent:-.5in"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial"><w:Sdt CheckBox="t"
 CheckBoxIsChecked="f" CheckBoxValueChecked="&#9746;" CheckBoxValueUnchecked="&#9744;"
 CheckBoxFontChecked="MS Gothic" CheckBoxFontUnchecked="MS Gothic"
 ID="-1053851806"><span style="font-family:"Segoe UI Symbol",sans-serif;
 mso-fareast-font-family:"MS Gothic";mso-bidi-font-family:"Segoe UI Symbol"">&#9744;</span></w:Sdt><span
style="mso-tab-count:1">            </span>I am authorized to submit this
report on behalf of <b style="mso-bidi-font-weight:normal"><u>(Name of the
organization)</u></b> and that I have examined the foregoing statements and to
the best of my knowledge they are true, correct, accurate and complete.<o:p></o:p></span></p>

<p class=MsoNormalCxSpMiddle style="margin-top:0in;margin-right:1.0pt;
margin-bottom:0in;margin-left:.5in;margin-bottom:.0001pt;mso-add-space:auto;
text-align:justify;text-indent:-.5in"><span style="font-size:11.0pt;font-family:
DINPro-Regular;mso-bidi-font-family:Arial"><w:Sdt CheckBox="t"
 CheckBoxIsChecked="f" CheckBoxValueChecked="&#9746;" CheckBoxValueUnchecked="&#9744;"
 CheckBoxFontChecked="MS Gothic" CheckBoxFontUnchecked="MS Gothic"
 ID="1107466269"><span style="font-family:"Segoe UI Symbol",sans-serif;
 mso-fareast-font-family:"MS Gothic";mso-bidi-font-family:"Segoe UI Symbol"">&#9744;</span></w:Sdt><span
style="mso-tab-count:1">            </span>I have submitted the quarter report
of the program"s expenditures with this progress report for the corresponding
time frame as requested by National Payments Corporation of India (THE
CONTRIBUTOR).<o:p></o:p></span></p>

<p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Name:<o:p></o:p></span></p>

<p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Designation:<o:p></o:p></span></p>

<p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
text-align:justify"><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Date: <o:p></o:p></span></p>

<p class=MsoNormalCxSpMiddle style="margin-right:1.0pt;mso-add-space:auto;
text-align:justify"><u><sup><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial"><o:p><span style="text-decoration:none">&nbsp;</span></o:p></span></sup></u></p>

<p class=MsoNormalCxSpLast style="margin-right:1.0pt;mso-add-space:auto;
text-align:justify"><u><sup><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">4</span></sup></u><u><span style="font-size:11.0pt;
font-family:DINPro-Regular;mso-bidi-font-family:Arial">Please note: <o:p></o:p></span></u></p>

<p class=MsoListParagraphCxSpFirst style="margin-right:.7pt;mso-add-space:auto;
text-align:justify;text-indent:-.25in;mso-list:l13 level1 lfo10"><![if !supportLists]><span
style="font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:
Symbol"><span style="mso-list:Ignore">·<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Photographs have to be high resolution images with
a minimum resolution of 1920x1080<u><o:p></o:p></u></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-right:.7pt;mso-add-space:
auto;text-align:justify;text-indent:-.25in;mso-list:l13 level1 lfo10"><![if !supportLists]><span
style="font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:
Symbol"><span style="mso-list:Ignore">·<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Minimum DPI of 300<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpLast style="margin-right:.7pt;mso-add-space:auto;
text-align:justify;text-indent:-.25in;mso-list:l13 level1 lfo10"><![if !supportLists]><span
style="font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:
Symbol"><span style="mso-list:Ignore">·<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Minimum files size between 2-5MB<o:p></o:p></span></p>

<p class=MsoNormal style="margin-right:.7pt;mso-add-space:auto;text-align:justify"><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoListParagraph style="text-align:justify;text-indent:-.25in;
mso-list:l3 level1 lfo6;mso-layout-grid-align:none;text-autospace:none"><![if !supportLists]><b
style="mso-bidi-font-weight:normal"><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">B.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span></b><![endif]><b style="mso-bidi-font-weight:normal"><u><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial">Annual project
report:<o:p></o:p></span></u></b></p>

<div style="mso-element:para-border-div;border-top:solid #4F81BD 1.0pt;
mso-border-top-themecolor:accent1;border-left:none;border-bottom:solid #4F81BD 1.0pt;
mso-border-bottom-themecolor:accent1;border-right:none;mso-border-top-alt:solid #4F81BD .5pt;
mso-border-top-themecolor:accent1;mso-border-bottom-alt:solid #4F81BD .5pt;
mso-border-bottom-themecolor:accent1;padding:10.0pt 0in 10.0pt 0in;margin-left:
.6in;margin-right:.6in">

<p class=MsoIntenseQuote style="margin:0in;margin-bottom:.0001pt;mso-add-space:
auto;text-align:justify"><b style="mso-bidi-font-weight:normal"><span
lang=EN-IN style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:
Arial;color:windowtext">Annual Project Report<o:p></o:p></span></b></p>

</div>

<p class=MsoNormalCxSpFirst style="text-align:justify;mso-layout-grid-align:
none;text-autospace:none"><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Annual project report should be in alignment with
project objective, goal, implementation plan and impact proposed. Kindly use
photographs, charts and graphs to depict and explain the impact and process of
the project. The framework of the project report format is as below. (<i
style="mso-bidi-font-style:normal"><u>Name of the organization</u></i>) can add
necessary relevant information in addition to below framework.<o:p></o:p></span></p>

<p class=MsoNormalCxSpLast style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoListParagraphCxSpFirst style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">A.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Introduction of NGO<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">B.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Contents of the report<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">C.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Message from head of the organisation about the
project <o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">D.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Mission of the organisation<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">E.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Project brief<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">F.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Project objective<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">G.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Project process flow<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">H.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Key activities conducted during the year<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">I.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Project impact<sup>1</sup><o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">J.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Major successes / challenges<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">K.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Project monitoring strategy<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">L.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Impact generated<sup>2</sup><o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">M.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Case studies<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">N.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Learnings and key observations<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">O.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Beneficiary Speak<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="margin-left:1.0in;mso-add-space:
auto;text-align:justify;text-indent:-.25in;mso-list:l15 level2 lfo11"><![if !supportLists]><span
style="font-family:DINPro-Regular;mso-fareast-font-family:DINPro-Regular;
mso-bidi-font-family:DINPro-Regular"><span style="mso-list:Ignore">a.<span
style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style="font-family:DINPro-Regular;mso-bidi-font-family:Arial">Feedback from the
end beneficiary and stakeholders<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">P.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Learnings of the Program Year and process changes
if any for next year of operations (if applicable)<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">Q.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Resource and financial management<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">R.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Budget and utilization statements<sup>3</sup><o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">S.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Way forward<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpLast style="text-align:justify;text-indent:-.25in;
mso-list:l15 level1 lfo11"><![if !supportLists]><span style="font-family:DINPro-Regular;
mso-fareast-font-family:DINPro-Regular;mso-bidi-font-family:DINPro-Regular"><span
style="mso-list:Ignore">T.<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">High resolution project photographs<sup>4</sup><o:p></o:p></span></p>

<p class=MsoNormalCxSpFirst style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial"><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><span style="font-size:
11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Cumulative impact
created by the interventions during the project year. Please use trends
wherever possible to show quarter-on-quarter correlation of impact and
progression/regression <o:p></o:p></span></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><sup><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">2</span></sup><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Please
include baseline v/s present data. Please show correlation to the targets
presented to the CSR Committee <o:p></o:p></span></p>

<p class=MsoNormalCxSpMiddle style="text-align:justify"><sup><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">3</span></sup><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Please
attached audited financial statements on the letterhead of the CA/Audit firm<o:p></o:p></span></p>

<p class=MsoNormalCxSpLast style="text-align:justify"><sup><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">4</span></sup><u><span
style="font-size:11.0pt;font-family:DINPro-Regular;mso-bidi-font-family:Arial">Please
note:</span></u><span style="font-size:11.0pt;font-family:DINPro-Regular;
mso-bidi-font-family:Arial"> <o:p></o:p></span></p>

<p class=MsoListParagraphCxSpFirst style="text-align:justify;text-indent:-.25in;
mso-list:l10 level1 lfo12"><![if !supportLists]><span style="font-family:Symbol;
mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol"><span
style="mso-list:Ignore">·<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Photographs have to be high resolution images with
a minimum resolution of 1920x1080<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpMiddle style="text-align:justify;text-indent:-.25in;
mso-list:l10 level1 lfo12"><![if !supportLists]><span style="font-family:Symbol;
mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol"><span
style="mso-list:Ignore">·<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Minimum DPI of 300<o:p></o:p></span></p>

<p class=MsoListParagraphCxSpLast style="text-align:justify;text-indent:-.25in;
mso-list:l10 level1 lfo12"><![if !supportLists]><span style="font-family:Symbol;
mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol"><span
style="mso-list:Ignore">·<span style="font:7.0pt "Times New Roman"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style="font-family:DINPro-Regular;
mso-bidi-font-family:Arial">Minimum files size between 2-5MB<o:p></o:p></span></p>

</div>

</body>

</html>';

   
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, "pt", [842,700], true, "UTF-8", false);
        //$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, "UTF-8", false);
        $pdf->setPageHeader = false;    
        $pdf->SGheaderTitle = "PDF Test" ;

        $pdf->SetMargins(PDF_MARGIN_LEFT, 5, PDF_MARGIN_RIGHT);              
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        //$pdf->SetHeaderMargin(5);
        //$pdf->setFooterData(array(0,64,0), array(0,64,128));
		$pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        if (@file_exists(dirname(__FILE__)."/lang/eng.php")) {
            require_once(dirname(__FILE__)."/lang/eng.php");
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont("helvetica", "", 8, "", false);
        $pdf->SetDisplayMode("fullpage", "SinglePage", "UseNone");
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor("Test ");
        $pdf->SetTitle("Test Pdf");
        $pdf->SetSubject("");
        //$pdf->AddPage("P","A4",false, false);
		$pdf->AddPage();
        $pdf->writeHTML($HeadTbl, true, false, true, false, "");
        $mypdfDet = getcwd()."/01TestPdf.pdf";
        if(is_file($mypdfDet))
            unlink($mypdfDet);
        $fileName = basename($mypdfDet);
        $pdf->Output(CONTRACT_PDF_PATH.$pdf_file_name, "F");// F File I View

  
    //============================================================+
    // END OF FILE
    //============================================================+
    }
	
	public function GenerateReceiptPdf($pdf_content,$pdf_file_name) {
 
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	
	//$pdf->SetHeaderMargin(5);
	//$pdf->setFooterData(array(0,64,0), array(0,64,128));
	$pdf->SetPrintHeader(false);
	$pdf->SetPrintFooter(false);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	if (@file_exists(dirname(__FILE__)."/lang/eng.php")) {
		require_once(dirname(__FILE__)."/lang/eng.php");
		$pdf->setLanguageArray($l);
	}
	$pdf->SetFont("helvetica", "", 8, "", false);
	$pdf->SetDisplayMode("fullpage", "SinglePage", "UseNone");
	$pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
	//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	//$pdf->AddPage("P","A4",false, false);
	$pdf->AddPage();
	
    // Set some content to print
	$html = <<<EOD
$pdf_content
     
EOD;
  
    // Print text using writeHTMLCell()
   $pdf->writeHTML($html, true, false, true, false, "");  
  
    // ---------------------------------------------------------    
  
    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    $pdf->Output(RECEIPT_PDF_PATH.$pdf_file_name, 'FD');    
  
    //============================================================+
    // END OF FILE
    //============================================================+
    }

    public function GenerateOrgPdf($pdf_content,$pdf_file_name) {
 
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);    
      
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('BCOD');
        $pdf->SetTitle(SITE_NAME);
        $pdf->SetSubject(SITE_NAME);
        $pdf->SetKeywords(SITE_NAME);   
      
        // set default header data
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128)); 
      
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED); 
      
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);    
      
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
      
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  
      
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }   
      
        // ---------------------------------------------------------    
      
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);   
      
        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 10, '', true);   
      
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage(); 
      
        // set text shadow effect
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));    
        
        // Set some content to print
        $html = <<<EOD
        $pdf_content  
EOD;

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);   
      
        // ---------------------------------------------------------    
      
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output(DOWNLOAD_PDF_PATH.$pdf_file_name, 'FD');      
      
        //============================================================+
        // END OF FILE
        //============================================================+
    }
}