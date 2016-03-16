<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 16/03/16
 * Time: 22:58
 */

namespace AI\Base;

class View
{
    // View ���ַ
    public $template_dir;
    // ������ļ��洢λ��
    public $compile_dir;
    // �洢 ����
    private $tem_var = array();
    public function assign($name, $value)
    {
        $this->tem_var[$name] = $value;
    }

    public function display($file)
    {
        $this->fetch($file);
    }

    //ʹ�� phpԭ��ģ��
    private function fetch($file)
    {
        $filePosition = $this->template_dir . $file;
        echo $filePosition;
        //  echo $filePosition;
        if (file_exists($filePosition)) {
            // ģ�����б����ֽ��Ϊ��������
            extract($this->tem_var, EXTR_OVERWRITE);
            include $filePosition;
        } else {
            E("ģ���ļ���{$filePosition}������");
        }
    }

}