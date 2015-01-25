<form name = 'fh' style = 'margin:0;' action = 'http://mops.twse.com.tw/mops/web/ajax_quickpgm' method = 'post' onsubmit = 'return false;'>
<input type = 'hidden' name = 'menusave' id = 'menusave' value =''>
<input type = 'hidden' name = 'firstin' value = '1'>
<input type = 'hidden' name = 'TYPEK' value = 'all'>
<input type = 'hidden' name = 'step' value = '1'>
<input type = 'hidden' name = 'keyh'>
<input type = 'hidden' name = 'keyhu'>
<input type = 'hidden' name = 'key1h'>
<input type = 'hidden' name = 'keycon' value = ''>
<input type = 'hidden' name = 'co_id' >
<input type = 'hidden' name = 'slth'>
<input type = 'hidden' name = 'slt1h'>
<input type = 'hidden' name = 'keyword1'>
<input type = 'hidden' name = 'TYPEK1'>
<input type = 'hidden' name = 'code1'>
<input type='hidden' name='checkbtn'>
<input type = 'hidden' name = 'co_id_1'>
<input type = 'hidden' name = 'co_id_2'>
<input type = 'hidden' name = 'sort' value = '1'>
<input type = 'hidden' name = 'date' >
<input type = 'hidden' name = 'noticeKind' >
<input type = 'hidden' name = 'noticeDate' value = '2'>
<input type = 'hidden' name = 'r1' value = '1'>
<input type = 'hidden' name = 'funcName' value = 't56sb01n_1'>
<input type = 'hidden' name = 'Stp' value = 'MH'>
<div id = "head">
<div id = "head_02">
<a href = "/mops/web/index" alt = "回首頁">
<img src = "images/blank.gif" width = "232" height = "52" border = "0"></a>
</div>
<div id = "head_03"><div id = "search_bar">
<div id = "nav">
<a href="#" onclick="document.fh.menusave.value='6';showIt2();chantxt6();hideIt2('quicksearch');hideIt2('quicksearch2');" id="itm6" style='color:yellow;'>個股</a>
<a href="#" onclick="document.fh.menusave.value='1';showIt1();chantxt1();hideIt2('quicksearch');hideIt2('quicksearch2');" id="itm1">資訊項目</a>
<a href="#" onclick="document.fh.menusave.value='2';showIt2();chantxt2();hideIt2('quicksearch');hideIt2('quicksearch2');" id="itm2">精華版2.0</a>
<a href="#" onclick="document.fh.menusave.value='4';showIt4();chantxt4();hideIt2('quicksearch');hideIt2('quicksearch2');" id="itm4">重大訊息</a></div>
<div id = "search_b1" align = 'left'>
<div class = "search" align = 'left'>
<table><tr><td align = 'left'>
<input name = "keyword" type = "text" class = "textbox" id = "keyword"  size = "45" value = '' onkeydown = "{if(event.keyCode == 13){showsh3('quicksearch','keyword');fh.step.value = '0';ajax1(document.fh,'quicksearch');}}" onclick = 'clskeyword();hideIt2("quicksearch");hideIt2("quicksearch2");'></td><td>
<div id = "quicksearch"  style = "display:none;z-index:2;position:absolute;overflow:auto;overflow-x:hidden;height:200px;top:28px;left:0px;width:160px;"></div></td><td>
<input   type = 'text' style = 'display:none' class = "textbox" name = 'keyword3' id = 'keyword3' size = 20 value = '' onclick = 'clskeyword1();hideIt2("quicksearch");hideIt2("quicksearch2");'></td><td><select name = "select" id = "sltdate" style = 'display:none' onclick = 'hideIt2("quicksearch");hideIt2("quicksearch2");'>
<option selected value = '1'>本日</option>
<option  value = '2'>最近3日</option>
<option  value = '3'>最近1週</option>
<option  value = '4'>最近1月</option>
<option  value = '5'>最近3月</option>
<option  value = '6'>最近半年</option>
<option  value = '7'>最近1年</option>
</select></td><td>
<select name = 'select1' style = 'display:none' id = 'sltitem' onclick = 'hideIt2("quicksearch");hideIt2("quicksearch2");'>
<option selected value = '1'>全部</option>
<option  value = '2'>資訊揭露</option>
<option  value = '3'>股務</option>
<option  value = '4'>財會內控</option>
</select>
</td>
<td>
<input type = "button" name = "rulesubmit" value = " 搜尋" onclick = "fh.key1h.value = fh.keyword3.value;fh.keyh.value = fh.keyword.value;fh.slth.value = fh.select.value;fh.slt1h.value = fh.select1.value;hideIt2('quicksearch');hideIt2('quicksearch2');goaction(fh.menusave.value);"></td><td>
<input style = 'display:none' type = "button" name = "return" value = "代號查詢" id = "stockid" onclick = "fh.checkbtn.value = '0';hideIt2('quicksearch');showsh2('quicksearch2','keyword');fh.step.value = '1';fh.keyword1.value = '';ajax1(document.fh,'quicksearch2');"></td>
<td>
</td>
</tr>
</table>
<div id = "quicksearch2" style = "z-index:2;position:absolute;overflow:auto;height:200px;max-height:200px;width:620px;display:none;" ></div>
</div>
</div>
<div id = "search_txt" class = "search_b2" style = "z-index:1;">
</div>
</div>
</div>
<div id = "head_04">
<a href = "http://emops.twse.com.tw/emops_all.htm"><img src = "images/blank.gif" width = "89" height = "32" border = "0" /></a><p><a href = "/mops/web/index"><img src = "images/blank.gif" width = "89" height = "32" border = "0" /></a></div></div></div>
</form>
