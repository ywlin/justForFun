<?php
$season = ['102-1.csv', '102-2.csv', '102-3.csv', '102-4.csv', '103-1.csv', '103-2.csv', '103-3.csv'];

// 分類到各個nameOfShare
foreach ($season as $key => $value) {
    $test = array();
    $file_contents[$key] = file_get_contents($season[$key]);
    $test = explode("\r", $file_contents[$key]);
    $dis = new DeconstructureIncomeStatement($test);

    //for ($i = 1; $i < count($test); $i++) {
    for ($i = 1; $i < 2; $i++) {
        if (',' == substr($test[$i], -1)) {
            $test[$i] = substr($test[$i], 0 , -1);
        }
        $listOfShare[$i] = explode(',', $test[$i]);
        $listOfShare[$i] = $dis->getKeyArray($listOfShare[$i]);
        file_put_contents('classifyByList/' . trim($listOfShare[$i]['code']) . '.csv', $test[$i] . "\r", FILE_APPEND);
    }
}

$files = $dis->getAllFileArray();
$ratioList = $dis->getIncomeStateRatio($files);
$dis->writeToCsv($ratioList);

//var_dump($ratioList);
class DeconstructureIncomeStatement
{
    /**
     *  1.計算營業收入(每個月 同時可以計算產業循環): 營收變化 影響公司成長力道，分成兩類 產業成熟的循環 與 邁向高度成長型的公司
     *  2.營業成本(cost of goods sold): 顯示企業的管理效率
     *  計算營業成本率 = 營業成本/營業收入  => 如果飆升 是負面的跡象
     *  3.營業毛利成長(影響中長期的規劃, 高毛利可以觀察同業的競爭門檻)
     *  營業毛利 = 營業收入 - 營業成本
     *  營業毛利率 = 營業毛利/營業收入 gross profit of margin(以同業相互比較)
     *  4.營業費用降低 => 把營業成本與營業費用一起計算，因為企業會做帳。
     *  5.營業利益 與 業外收益
     *  營業利益率: 營業利益/營業收入 => 與毛利率互相比較 兩者趨勢基本上要一致 若不一致 只參考營業利益率
     *  業外貢獻過大 EPS要打折 且當本業獲利 但是業外出現常態性虧損 就要注意
     *  6.所得稅利益:
     *  7.稅前淨利 稅後淨利：企業長期競爭力指標
     *  稅前盈餘 稅後盈餘 每股盈餘
     */
    public $nominalList = [
        'code', //'公司代號',
        'title', //'公司名稱',
        'operatingRevenue', //'營業收入',
        'costOfGoodsSold', //'營業成本': 為了賺取營業收入而產生的銷收產品或提供勞務成本
        'operatingGross', //'營業毛利(毛損)',
        '未實現銷貨(損)益',
        '已實現銷貨(損)益',
        '營業毛利(毛損)淨額',
        'operatingExpense', //'營業費用':其他與經常營業相關的費用，如 銷售 廣告 管理 總務 研發等
        '其他收益及費損淨額',
        'operatingProfits', //'營業利益(損失)',
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
        'EPS', //'基本每股盈餘(元)'
    ];

    public $raw;
    public function __construct(array $raw)
    {
        $this->raw = $raw;
    }


    public function getIncomeStateRatio(array $files)
    {
        foreach ($files as $filename) {
            $contents = file_get_contents('./classifyByList/' . $filename);
            $content[$filename] = explode("\r", $contents);
            $ratioList[$filename]['filename'][] = $filename;
            $ratioList[$filename]['COGSratio'][] = 'COGSratio營業成本率';
            $ratioList[$filename]['grossGrow'][] = 'grossGrow營業毛利率';
            $ratioList[$filename]['operationNet'][] = 'operationNet營業利益率';
            $ratioList[$filename]['ratioOperatingRevenue'][] = 'ratioOperatingRevenue營業收入成長比例';
            $ratioList[$filename]['costAndExpense'][] = 'costAndExpense營業費用成長比例';

            for ($i = 0; $i < count($content[$filename]) - 1; $i++) {
                $content[$filename][$i] = explode(',', $content[$filename][$i]);
                $content[$filename][$i] = $this->getKeyArray($content[$filename][$i]);
                // 營業成本率
                $ratioList[$filename]['COGSratio'][] = round($content[$filename][$i]['costOfGoodsSold'] / $content[$filename][$i]['operatingRevenue'], 2);
                // 營業毛利率
                $ratioList[$filename]['grossGrow'][] = round($content[$filename][$i]['operatingGross'] / $content[$filename][$i]['operatingRevenue'] , 2);
                // 營業利益率
                $ratioList[$filename]['operationNet'][] = round($content[$filename][$i]['operatingProfits'] / $content[$filename][$i]['operatingRevenue'], 2);
                if ($i > 0) {
                    // 營業收入 成長比例
                    $thisOR = $content[$filename][$i]['operatingRevenue'];
                    $lastOR = $content[$filename][$i - 1]['operatingRevenue'];
                    $ratioList[$filename]['ratioOperatingRevenue'][$i] = round(($thisOR - $lastOR) / $lastOR, 2);

                    // 營業費用 成長比例
                    $thisS = $content[$filename][$i]['costOfGoodsSold'] + $content[$filename][$i]['operatingExpense'];
                    $lastS = $content[$filename][$i - 1]['costOfGoodsSold'] + $content[$filename][$i - 1]['operatingExpense'];
                    $ratioList[$filename]['costAndExpense'][$i] = round(($thisS - $lastS) / $lastS, 2);
                }
            }
        }
        return $ratioList;
    }
    /**
     * key and value
     */
    public function getKeyArray(array $companyIS)
    {
        return array_combine($this->nominalList, $companyIS);
    }

    public function getAllFileArray()
    {
        if ($handle = opendir('./classifyByList')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $files[] = $entry;
                }
            }
            closedir($handle);
        }
        return $files;
    }

    public function writeToCsv(array $ratioList)
    {
        $fp = fopen('file.csv', 'w');

        foreach ($ratioList as $fields) {
            foreach ($fields as $field) {
                fputcsv($fp, $field);
            }
        }
        fclose($fp);
    }
}
