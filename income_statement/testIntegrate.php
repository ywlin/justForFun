<?php

$file_contents = file_get_contents('102-1.csv');
var_dump($file_contents);
class DeconstructureIncomeStatement
{
    public $nominalList = [
        'code', //'公司代號',
        'title', //'公司名稱',
        'operatingIncome', //'營業收入',
        'costOfGoodsSold', //'營業成本': 為了賺取營業收入而產生的銷收產品或提供勞務成本
        'operatingGross', //'營業毛利(毛損)',
        '未實現銷貨(損)益',
        '已實現銷貨(損)益',
        '營業毛利(毛損)淨額',
        'operatingExpense', //'營業費用':其他與經常營業相關的費用，如 銷售 廣告 管理 總務 研發等
        '其他收益及費損淨額',
        '營業利益(損失)',
        '營業外收入及支出',
        '稅前淨利(淨損)',
        '所得稅費用(利益)',
        '繼續營業單位本期淨利(淨損)',
        '停業單位損益',
        '合併前非屬共同控制股權損益',
        '本期淨利(淨損)',
        '其他綜合損益(淨額)',
        '合併前非屬共同控制股權綜合損益淨額',
        '本期綜合損益總額',
        '淨利(淨損)歸屬於母公司業主',
        '淨利(淨損)歸屬於共同控制下前手權益',
        '淨利(淨損)歸屬於非控制權益',
        '綜合損益總額歸屬於母公司業主',
        '綜合損益總額歸屬於共同控制下前手權益',
        '綜合損益總額歸屬於非控制權益',
        '基本每股盈餘(元)'
    ];

    public $raw;
    public function __construct(array $raw)
    {
        $this->raw = $raw;
    }
}
