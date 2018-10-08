<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------
|修改功能本類功能-全都要求登入後才能使用
|管理員專用程式
|以下程式是為了更換LOGINKEY2而寫
|--------------------------------
*/
require_once 'Is_base.php';	//載入共同部分
class Suffixbig extends IsBase {
	/*Fuction List*********************************************************************************************************
	
	index 			修改密碼
	**********************************************************************************************************************/
	public $mydata;
	public $l;//放語言
	/*** 共同載入部分 ********************************************************************************************************/
	// CI_Controller 設定，測試無法使用 [共同載入部分]
	function __construct() {
        parent::__construct(); // 初始化
        $this->mydata['br']="<br>\n";
    }
    

    //翻譯補助類
    //翻譯重複字檢查Translate duplicate word check
    //----------------------------------------------------------------------------------------------------------/
	public
	function twcheck() {
        $br= $this->mydata['br'];
		//======================================================================================================
		// $langs	代表語言策略1所有翻譯字
        // $_l		代表語言策略2所有翻譯字
        unset($this->mData);
        $language = 'zh-tw';
        $file=$this->config->item( 'my_dir' ) . '/_inc/language/' . $language ."/". $language . '.php';
        require($file);//載入語言策略第2個檔
        $_1=$_;
        echo $language."語言翻譯檔，共有字串".count($_)."個".$br;
            $inputValue=$_;
            $inputValue_unique = array_unique($inputValue);
            $s=count($inputValue)-count($inputValue_unique);

        echo "重複".$s."個(值重複無所謂)".$br;
            if($s>0){
                echo "<hr>";
                $repeat_arr = array_diff_assoc ( $inputValue, $inputValue_unique ); // 获取重复数据的数组
                foreach($repeat_arr as $k=>$v ){
                    echo "['".$k."']=".$v.$br;
                }
                echo "<hr>";
            }

        // 開啟檔案
        $file = fopen($file, 'rb');
        $sa1=0;$sa2=0;
        $repeat=array();
        $repeatb=array();
        // 檢查檔案是否到結尾，若尚未到結尾則取出一行文字
        while ((!feof($file) && $line = trim(fgets($file)))) {
            if((preg_match("@^\/\/@i", $line )))
            {
                $sa1++;
            }
            if((preg_match("@\_\['@i", $line )))
            {
                $src=substr($line,4,(strpos($line,"']")-4));//切=之前的字
                if(in_array($src,$repeat)){
                    $repeatb[]=$src;                
                }
                $repeat[]=$src;
                $sa2++;
            }
        }
        // 關閉檔案
        fclose($file);
        //---------------------------------------------------------------------
        echo "註解".$sa1."行".$br;
        echo "內容".$sa2."行".$br;
        echo "key重複".($sa2-count($_1))."這個不要有重複".$br;
        echo "<hr>";
        foreach($repeatb as $k=>$v ){
            echo $v.$br;
        }
        echo "<hr>";
        echo $br.$br;

        echo "英文版".$br;
        unset($_);
        $language = 'en';
        $file=$this->config->item( 'my_dir' ) . '/_inc/language/' . $language ."/". $language . '.php';
        require($file);//載入語言策略第2個檔
        $_2=$_;
        echo $language."語言翻譯檔，共有字串".count($_)."個".$br;
            $inputValue=$_2;
            $inputValue_unique = array_unique($inputValue);
            $s=count($inputValue)-count($inputValue_unique);
        echo "值重複".$s."個(值重複無所謂)".$br;
            if($s>0){
                echo "<hr>";
                $repeat_arr = array_diff_assoc ( $inputValue, $inputValue_unique ); // 获取重复数据的数组
                foreach($repeat_arr as $k=>$v ){
                    echo "['".$k."']=".$v.$br;
                }
                echo "<hr>";
            }

        // 開啟檔案
        $file = fopen($file, 'rb');
        $sa1=0;$sa2=0;
        $repeat=array();
        $repeatb=array();
        // 檢查檔案是否到結尾，若尚未到結尾則取出一行文字
        while ((!feof($file) && $line = trim(fgets($file)))) {
            if((preg_match("@^\/\/@i", $line )))
            {
                $sa1++;
            }
            if((preg_match("@\_\['@i", $line )))
            {
                $src=substr($line,4,(strpos($line,"']")-4));//切=之前的字
                if(in_array($src,$repeat)){
                    $repeatb[]=$src;                
                }
                $repeat[]=$src;
                $sa2++;
            }
        }
        // 關閉檔案
        fclose($file);
        //---------------------------------------------------------------------
        echo "註解".$sa1."行".$br;
        echo "內容".$sa2."行".$br;
        echo "key重複".($sa2-count($_1))."這個不要有重複".$br;
        echo "<hr>";
        foreach($repeatb as $k=>$v ){
            echo $v.$br;
        }
        echo "<hr>";
        echo $br.$br;


        echo "<hr>";
        echo "和英文版做比對".$br;
        foreach($_1 as $k=>$v ){
            $y1[]=$k;
        }
        foreach($_2 as $k=>$v ){
            $y2[]=$k;
        }
        echo "<hr>";
        //$repeat_arr = array_diff_assoc ( $_1, $_2 ); // 获取重复数据的数组
        $repeat_arr = array_diff_assoc ( $y1, $y2 ); // 获取重复数据的数组
        foreach($repeat_arr as $k=>$v ){
            echo "['".$k."']=".$v.$br;
        }
        echo "<hr>"; 
		//======================================================================================================
    }   
    //----------------------------------------------------------------------------------------------------------/
	//----------------------------------------------------------------------------------------------------------/
	public
	function test() {
		$_l=$this->mData[ '_l' ];//使用語言策略變數
		echo print_r($_l);//"測試";
	}
}