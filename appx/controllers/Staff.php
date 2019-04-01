<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this -> load -> model('person');
        $this -> load -> model('student_model');
        //$this -> is_logged_in();
    }
    function is_logged_in() {
		$is_logged_in = $this -> session -> userdata('is_logged_in');
		if (!isset($is_logged_in) || $is_logged_in != 1) {
			echo 'you have no permission to use developer area'. '<a href="">Login</a>';
			die();
		}
	}


    public function angular_view_welcome(){
        ?>
        <style type="text/css">
            body{
                background-color: #1b1e21;
            }
            #staff-area{
                height: 100vh;
                width: 99vw;
            }
        </style>
        <div class="card" id="staff-area" style="overflow-y: auto">
            <div class="card-header bg-gray-3">
                <!-- Menu will be here -->
                <?php
                   require_once("menu_staff.php");
                ?>
            </div>
            <div class="card-body">
                <div id="Languages"><a class="hy" href="http://hy.lipsum.com/">&#1344;&#1377;&#1397;&#1381;&#1408;&#1381;&#1398;</a> <a class="sq" href="http://sq.lipsum.com/">Shqip</a> <span class="ltr" dir="ltr"><a class="xx" href="http://ar.lipsum.com/"><img src="/images/ar.gif" width="18" height="12" alt="&#8235;&#1575;&#1604;&#1593;&#1585;&#1576;&#1610;&#1577;" /></a><a class="xx" href="http://ar.lipsum.com/">&#8235;&#1575;&#1604;&#1593;&#1585;&#1576;&#1610;&#1577;</a></span>&nbsp;&nbsp; <a class="bg" href="http://bg.lipsum.com/">&#1041;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080;</a> <a class="ca" href="http://ca.lipsum.com/">Catal&agrave;</a> <a class="cn" href="http://cn.lipsum.com/">&#20013;&#25991;&#31616;&#20307;</a> <a class="hr" href="http://hr.lipsum.com/">Hrvatski</a> <a class="cs" href="http://cs.lipsum.com/">&#268;esky</a> <a class="da" href="http://da.lipsum.com/">Dansk</a> <a class="nl" href="http://nl.lipsum.com/">Nederlands</a> <a class="en zz" href="http://www.lipsum.com/">English</a> <a class="et" href="http://et.lipsum.com/">Eesti</a> <a class="ph" href="http://ph.lipsum.com/">Filipino</a> <a class="fi" href="http://fi.lipsum.com/">Suomi</a> <a class="fr" href="http://fr.lipsum.com/">Fran&ccedil;ais</a> <a class="ka" href="http://ka.lipsum.com/">&#4325;&#4304;&#4320;&#4311;&#4323;&#4314;&#4312;</a> <a class="de" href="http://de.lipsum.com/">Deutsch</a> <a class="el" href="http://el.lipsum.com/">&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;</a> <span class="ltr" dir="ltr"><a class="xx" href="http://he.lipsum.com/"><img src="/images/he.gif" width="18" height="12" alt="&#8235;&#1506;&#1489;&#1512;&#1497;&#1514;" /></a><a class="xx" href="http://he.lipsum.com/">&#8235;&#1506;&#1489;&#1512;&#1497;&#1514;</a></span>&nbsp;&nbsp; <a class="hi" href="http://hi.lipsum.com/">&#2361;&#2367;&#2344;&#2381;&#2342;&#2368;</a> <a class="hu" href="http://hu.lipsum.com/">Magyar</a> <a class="id" href="http://id.lipsum.com/">Indonesia</a> <a class="it" href="http://it.lipsum.com/">Italiano</a> <a class="lv" href="http://lv.lipsum.com/">Latviski</a> <a class="lt" href="http://lt.lipsum.com/">Lietuvi&scaron;kai</a> <a class="mk" href="http://mk.lipsum.com/">&#1084;&#1072;&#1082;&#1077;&#1076;&#1086;&#1085;&#1089;&#1082;&#1080;</a> <a class="ms" href="http://ms.lipsum.com/">Melayu</a> <a class="no" href="http://no.lipsum.com/">Norsk</a> <a class="pl" href="http://pl.lipsum.com/">Polski</a> <a class="pt" href="http://pt.lipsum.com/">Portugu&ecirc;s</a> <a class="ro" href="http://ro.lipsum.com/">Rom&acirc;na</a> <a class="ru" href="http://ru.lipsum.com/">Pycc&#1082;&#1080;&#1081;</a> <a class="sr" href="http://sr.lipsum.com/">&#1057;&#1088;&#1087;&#1089;&#1082;&#1080;</a> <a class="sk" href="http://sk.lipsum.com/">Sloven&#269;ina</a> <a class="sl" href="http://sl.lipsum.com/">Sloven&#353;&#269;ina</a> <a class="es" href="http://es.lipsum.com/">Espa&ntilde;ol</a> <a class="sv" href="http://sv.lipsum.com/">Svenska</a> <a class="th" href="http://th.lipsum.com/">&#3652;&#3607;&#3618;</a> <a class="tr" href="http://tr.lipsum.com/">T&uuml;rk&ccedil;e</a> <a class="uk" href="http://uk.lipsum.com/">&#1059;&#1082;&#1088;&#1072;&#1111;&#1085;&#1089;&#1100;&#1082;&#1072;</a> <a class="vi" href="http://vi.lipsum.com/">Ti&#7871;ng Vi&#7879;t</a> </div>

                <h1>Lorem Ipsum</h1>
                <h4>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."</h4>
                <h5>"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..."</h5>


                <hr />

                <div id="Content">
                    <div id="bannerL"><div id="div-gpt-ad-1474537762122-2">
                            <script type="text/javascript">googletag.cmd.push(function() { googletag.display("div-gpt-ad-1474537762122-2"); });</script>
                        </div></div>
                    <div id="bannerR"><div id="div-gpt-ad-1474537762122-3">
                            <script type="text/javascript">googletag.cmd.push(function() { googletag.display("div-gpt-ad-1474537762122-3"); });</script>
                        </div></div>
                    <div id="Panes"><div>
                            <h2>What is Lorem Ipsum?</h2>
                            <p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </div><div>
                            <h2>Why do we use it?</h2>
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                        </div><br /><div>
                            <h2>Where does it come from?</h2>
                            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
                        </div><div>
                            <h2>Where can I get some?</h2>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
                            <form method="post" action="/feed/html"><table style="width:100%"><tr><td rowspan="2"><input type="text" name="amount" value="5" size="3" id="amount" /></td><td rowspan="2"><table style="text-align:left"><tr><td style="width:20px"><input type="radio" name="what" value="paras" id="paras" checked="checked" /></td><td><label for="paras">paragraphs</label></td></tr><tr><td style="width:20px"><input type="radio" name="what" value="words" id="words" /></td><td><label for="words">words</label></td></tr><tr><td style="width:20px"><input type="radio" name="what" value="bytes" id="bytes" /></td><td><label for="bytes">bytes</label></td></tr><tr><td style="width:20px"><input type="radio" name="what" value="lists" id="lists" /></td><td><label for="lists">lists</label></td></tr></table></td><td style="width:20px"><input type="checkbox" name="start" id="start" value="yes" checked="checked" /></td><td style="text-align:left"><label for="start">Start with 'Lorem<br />ipsum dolor sit amet...'</label></td></tr><tr><td></td><td style="text-align:left"><input type="submit" name="generate" id="generate" value="Generate Lorem Ipsum" /></td></tr></table></form></div><br /></div>
                    <hr /><div class="boxed" style="color:#ff0000;"><strong>Translations:</strong> Can you help translate this site into a foreign language ? Please email us with details if you can help.</div>

                    <hr /><div class="boxed">There are now a set of mock banners available <a href="/banners" class="lnk">here</a> in three colours and in a range of standard banner sizes:<br /><a href="/banners"><img src="/images/banners/black_234x60.gif" width="234" height="60" alt="Banners" /></a><a href="/banners"><img src="/images/banners/grey_234x60.gif" width="234" height="60" alt="Banners" /></a><a href="/banners"><img src="/images/banners/white_234x60.gif" width="234" height="60" alt="Banners" /></a></div>

                    <hr /><div class="boxed"><strong>Donate:</strong> If you use this site regularly and would like to help keep the site on the Internet, please consider donating a small sum to help pay for the hosting and bandwidth bill. There is no minimum donation, any sum is appreciated - click <a target="_blank" href="/donate" class="lnk">here</a> to donate using PayPal. Thank you for your support.</div>

                    <hr /><div class="boxed" id="Packages">
                        <a target="_blank" rel="nofollow" href="https://chrome.google.com/extensions/detail/jkkggolejkaoanbjnmkakgjcdcnpfkgi">Chrome</a>
                        <a target="_blank" rel="nofollow" href="https://addons.mozilla.org/en-US/firefox/addon/dummy-lipsum/">Firefox Add-on</a>
                        <a target="_blank" rel="nofollow" href="https://github.com/traviskaufman/node-lipsum">NodeJS</a>
                        <a target="_blank" rel="nofollow" href="http://ftp.ktug.or.kr/tex-archive/help/Catalogue/entries/lipsum.html">TeX Package</a>
                        <a target="_blank" rel="nofollow" href="http://code.google.com/p/pypsum/">Python Interface</a>
                        <a target="_blank" rel="nofollow" href="http://gtklipsum.sourceforge.net/">GTK Lipsum</a>
                        <a target="_blank" rel="nofollow" href="http://github.com/gsavage/lorem_ipsum/tree/master">Rails</a>
                        <a target="_blank" rel="nofollow" href="https://github.com/cerkit/LoremIpsum/">.NET</a>
                        <a target="_blank" rel="nofollow" href="http://groovyconsole.appspot.com/script/64002">Groovy</a>
                        <a target="_blank" rel="nofollow" href="http://www.layerhero.com/lorem-ipsum-generator/">Adobe Plugin</a></div>

                    <hr /><div id="Lipsum-Unit5" style="margin:10px 0">
                        <script type="text/javascript">googletag.cmd.push(function() { googletag.display("Lipsum-Unit5"); });</script>
                    </div>
                    <hr /><div id="Translation">

                        <h3>The standard Lorem Ipsum passage, used since the 1500s</h3><p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p><h3>Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC</h3><p>"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</p>
                        <h3>1914 translation by H. Rackham</h3>
                        <p>"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"</p>
                        <h3>Section 1.10.33 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC</h3>
                        <p>"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."</p>
                        <h3>1914 translation by H. Rackham</h3>
                        <p>"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains."</p>
                    </div>

                </div>

                <hr />

                <div class="boxed"><a style="text-decoration:none" href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#104;&#101;&#108;&#112;&#64;&#108;&#105;&#112;&#115;&#117;&#109;&#46;&#99;&#111;&#109;">&#104;&#101;&#108;&#112;&#64;&#108;&#105;&#112;&#115;&#117;&#109;&#46;&#99;&#111;&#109;</a><br /><a style="text-decoration:none" target="_blank" href="/privacy.pdf" />Privacy Policy</a></div>

            </div>
            <div class="card-footer" ng-show="showDeveloperArea">
                <div class="d-flex">
                    <div class="col bg-gray-3">
                        This is development area dfgsdfg
                    </div>
                    <div class="col bg-gray-4">
                        sdfgsdf
                    </div>
                    <div class="col bg-gray-5">
                        ghdfgh
                    </div>
                </div>
            </div>
        </div>
        <?php
    }




}
?>