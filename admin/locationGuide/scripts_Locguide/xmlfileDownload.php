<?
$file='../../xmlpages/LocationGuideXML/'.$_POST['donwloadSeleGuide'].'.xml';
echo $_POST['donwloadSeleGuide'];
if (file_exists($file)) {
	//base on PHP manual http://www.php.net/manual/en/function.header.php
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    //readfile($file);
    exit;
	}
	else
	{
		printf("<script>alert('Cannot find the XML file!!');location.href='../../Home.php'</script>");
	}
	

    ?>