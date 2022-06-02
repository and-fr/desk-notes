<?php

function DisplayRichTextMenu()
{

echo <<<EOT
    <div class="rich-text-menu">

        <b>Tags:</b>
        <input type="button" onclick="insertAtCaret('text', '<h3></h3>')" value="h3">
        <input type="button" onclick="insertAtCaret('text', '<h4></h4>')" value="h4">
        <input type="button" onclick="insertAtCaret('text', '<h5></h5>')" value="h5">
        <input type="button" onclick="insertAtCaret('text', '<h6></h6>')" value="h6">
        <input type="button" onclick="insertAtCaret('text', '<p></p>')" value="p">
        <input type="button" onclick="insertAtCaret('text', '<b></b>')" value="b">
        <input type="button" onclick="insertAtCaret('text', '<sup></sup>')" value="sup">
        <input type="button" onclick="insertAtCaret('text', '<sub></sub>')" value="sub">
        <input type="button" onclick="insertAtCaret('text', 'ul')" value="ul">
        <input type="button" onclick="insertAtCaret('text', 'table-header')" value="table.h" title="with header">
        <input type="button" onclick="insertAtCaret('text', 'table-tools')" value="table.t" title="with class of tools">
        <input type="button" onclick="insertAtCaret('text', 'image')" value="img">
        <input type="button" onclick="insertAtCaret('text', 'pretext')" value=".pretext">
        <input type="button" onclick="insertAtCaret('text', 'jumbo')" value=".jumbo">
        <input type="button" onclick="insertAtCaret('text', 'info')" value=".info">
        
        &nbsp;
        <b>Chars:</b>
        <input type="button" onclick="insertAtCaret('text', 'tab')" value="tab">

        &nbsp;
        <b>Physics:</b>
        <input type="button" onclick="insertAtCaret('text', '&deg;')" value="&deg;" title="Celsius">
        <input type="button" onclick="insertAtCaret('text', '&alpha;')" value="&alpha;" title="alpha">
        <input type="button" onclick="insertAtCaret('text', '&beta;')" value="&beta;" title="beta">
        <input type="button" onclick="insertAtCaret('text', '&Omega;')" value="&Omega;" title="Omega">
        <input type="button" onclick="insertAtCaret('text', '&omega;')" value="&omega;" title="Omega (small)">
        <input type="button" onclick="insertAtCaret('text', '&phi;')" value="&phi;" title="Phi">
        <input type="button" onclick="insertAtCaret('text', '&pi;')" value="&pi;" title="Pi (small)">
        <input type="button" onclick="insertAtCaret('text', '&epsiv;')" value="&epsiv;" title="&epsiv;">
        <input type="button" onclick="insertAtCaret('text', '&lambda;')" value="&lambda;" title="lambda">

        &nbsp;
        <b>Law:</b>
        <input type="button" onclick="insertAtCaret('text', '&sect;')" value="&sect;" title="Paragraph">

        <br>
        <b>Math</b>: 
        <input type="button" onclick="insertAtCaret('text', '&and;')" value="&and;" title="and">
        <input type="button" onclick="insertAtCaret('text', '&or;')" value="&or;" title="or">
        <input type="button" onclick="insertAtCaret('text', '∪')" value="∪" title="Union">
        <input type="button" onclick="insertAtCaret('text', '∩')" value="∩" title="Intersection">
        <input type="button" onclick="insertAtCaret('text', '⊕')" value="⊕" title="Circle Plus">
        <input type="button" onclick="insertAtCaret('text', '&SquareUnion;')" value="&SquareUnion;" title="Suma rozłączna">
        <input type="button" onclick="insertAtCaret('text', '&lceil;&rceil;')" value="&lceil;&rceil;" title="Ceiling">
        <input type="button" onclick="insertAtCaret('text', '&lfloor;&rfloor;')" value="&lfloor;&rfloor;" title="Floor">
        <input type="button" onclick="insertAtCaret('text', '&asymp;')" value="&asymp;" title="&asymp;">
        <input type="button" onclick="insertAtCaret('text', '&Congruent;')" value="&Congruent;" title="Kongruencja">
        <input type="button" onclick="insertAtCaret('text', '&NotCongruent;')" value="&NotCongruent;" title="!Kongruencja">
        <input type="button" onclick="insertAtCaret('text', '&le;')" value="&le;" title="Less or Equal">
        <input type="button" onclick="insertAtCaret('text', '&ne;')" value="&ne;" title="Not Equal">
        <input type="button" onclick="insertAtCaret('text', '&ge;')" value="&ge;" title="Equal or Greater">
        <input type="button" onclick="insertAtCaret('text', '&rArr;')" value="&rArr;" title="Implies">
        <input type="button" onclick="insertAtCaret('text', '&isin;')" value="&isin;" title="Is In">
        <input type="button" onclick="insertAtCaret('text', '&notin;')" value="&notin;" title="In Not In">

        <input type="button" onclick="insertAtCaret('text', '&empty;')" value="&empty;" title="Empty Set">
        <input type="button" onclick="insertAtCaret('text', '&forall;')" value="&forall;" title="For All (dla każdego)">
        <input type="button" onclick="insertAtCaret('text', '&exist;')" value="&exist;" title="Exists">
        <input type="button" onclick="insertAtCaret('text', '&nexist;')" value="&nexist;" title="Not Exists">
        <input type="button" onclick="insertAtCaret('text', '&not;')" value="&not;" title="Negation">
        <input type="button" onclick="insertAtCaret('text', '&larr;')" value="&larr;" title="Left arrow">
        <input type="button" onclick="insertAtCaret('text', '&rarr;')" value="&rarr;" title="Implikuje">
        <input type="button" onclick="insertAtCaret('text', '&harr;')" value="&harr;" title="Wtedy i tylko wtedy">
        <input type="button" onclick="insertAtCaret('text', '&hArr;')" value="&hArr;" title="Wtedy i tylko wtedy">
        <input type="button" onclick="insertAtCaret('text', '&sube;')" value="&sube;" title="Jest podzbiorem">

        <input type="button" onclick="insertAtCaret('text', '&EmptySmallSquare;')" value="&EmptySmallSquare;" title="Square (ends finished proof)">
        <input type="button" onclick="insertAtCaret('text', '&MinusPlus;')" value="&MinusPlus;" title="Plus-Minus">
        <input type="button" onclick="insertAtCaret('text', '&infin;')" value="&infin;" title="Infinity">
        <input type="button" onclick="insertAtCaret('text', '√')" value="√" title="squre root">
        <input type="button" onclick="insertAtCaret('text', '&Delta;')" value="&Delta;" title="Delta">
        <input type="button" onclick="insertAtCaret('text', 'macron')" value="&macr;" title="Macron (using span tags)">
        <input type="button" onclick="insertAtCaret('text', '&middot;')" value="&middot;" title="Multiplication">
        <input type="button" onclick="insertAtCaret('text', '&uparrow;')" value="&uparrow;" title="Up arrow">
        <input type="button" onclick="insertAtCaret('text', '&downarrow;')" value="&downarrow;" title="Down arrow">
        <input type="button" onclick="insertAtCaret('text', '↙')" value="↙" title="↙">
        <input type="button" onclick="insertAtCaret('text', '↖')" value="↖" title="↖">
        <input type="button" onclick="insertAtCaret('text', '&nearr;')" value="&nearr;" title="Increases">
        <input type="button" onclick="insertAtCaret('text', '&searr;')" value="&searr;" title="Decreases">
        <input type="button" onclick="insertAtCaret('text', 'frac')" value="1/2" title="Fractions">
        <input type="button" onclick="insertAtCaret('text', 'lim')" value="lim" title="Limes">
        <input type="button" onclick="insertAtCaret('text', 'sum')" value="sum" title="Sum">
        <input type="button" onclick="insertAtCaret('text', '&Product;')" value="&Product;" title="Product">
        <input type="button" onclick="insertAtCaret('text', '∫')" value="∫" title="Calka">
        <input type="button" onclick="insertAtCaret('text', 'x̄')" value="x̄" title="Srednia">
    </div>
EOT;



}



?>
