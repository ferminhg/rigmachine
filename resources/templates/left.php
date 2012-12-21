<div id="left">
    <div style="padding: 3px 0pt; background: rgb(241, 241, 241) none repeat scroll 0% 0%; width: 100%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous; font-size: 12px;">
        Related
    </div>
        <div class="filters">
            <h5><span style="">Brands</span></h5>
            <ul id="brand_list">
            <li><a class="cav" href="/brand/ibanez"><span class="rel"><span class="a">Ibanez</span> <span class="count">(131)</span></span></a></li>
<li><a class="cav" href="/brand/gibson"><span class="rel"><span class="a">Gibson</span> <span class="count">(105)</span></span></a></li>
<li><a class="cav" href="/brand/bc-rich"><span class="rel"><span class="a">BC Rich</span> <span class="count">(36)</span></span></a></li>
<li><a class="cav" href="/brand/prs--paul-reed-smith-"><span class="rel"><span class="a">PRS (Paul Reed Smith)</span> <span class="count">(36)</span></span></a></li>
<li><a class="cav" href="/brand/rickenbacker"><span class="rel"><span class="a">Rickenbacker</span> <span class="count">(4)</span></span></a></li>
                <li><a class="cav" href="#" onclick="javascript:seeAllBrand(); return false;"><span class="rel">more …</span></a></li>
            </ul>
        </div>
        <div class="filters">
            <h5><span style="">Bands</span></h5>
            <ul>
            <li><a class="cav" href="/band/celere"><span class="rel"><span class="a">célere</span></span></a></li>
<li><a class="cav" href="/band/fuckop-family"><span class="rel"><span class="a">fuckop family</span></span></a></li>
<li><a class="cav" href="/band/nahi"><span class="rel"><span class="a">nähi</span></span></a></li>
<li><a class="cav" href="/band/nirvana"><span class="rel"><span class="a">nirvana</span></span></a></li>
<li><a class="cav" href="/band/noun"><span class="rel"><span class="a">noun</span></span></a></li>
                <li><a class="cav" href="#" onclick="javascript:seeAllBrand()"><span class="rel">more …</span></a></li>
            </ul>
        </div>
        <div class="filters">
            <h5><span style="">Artist</span></h5>
            <ul>
            <li><a class="cav" href="/artist/javi-belze"><span class="rel"><span class="a">javi belze</span></span></a></li>
<li><a class="cav" href="/artist/kurt-cobain"><span class="rel"><span class="a">kurt cobain</span></span></a></li>
<li><a class="cav" href="/artist/mutha"><span class="rel"><span class="a">mutha</span></span></a></li>
<li><a class="cav" href="/artist/pedro-martinez"><span class="rel"><span class="a">pedro martínez</span></span></a></li>
                <li><a class="cav" href="#" onclick="javascript:seeAllBrand()"><span class="rel">more …</span></a></li>
            </ul>
        </div>
</div>
<script>
function seeAllBrand(){
    $.ajax({type: "GET",
           url: '/lib/php/brand/getAllFiltro.php',
           success: function(msg){
                $('#brand_list').html(msg);
           }
    });
    }
</script>