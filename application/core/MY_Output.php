<?php


class MY_Output extends CI_Output
{
    /**
     * 出力にlayoutを適用する。
     */
    public function _display($output = '')
    {
        if ($output === '') {
            $output = &$this->final_output;
        }

        $str = get_instance()->load->view('layout', array('content' => $output), true);

        return parent::_display($str);
    }
}
