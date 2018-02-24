var page = require('webpage').create();
var system = require('system');
var login="http://localhost:7001/index.php"
var data="email=admin@gmail.com&pass=t_Su__I_s_N_o1&btn-login="
var url=system.args[1];
page.open(login,'post',data, function (status) {
    if (status !== 'success') {
        console.log('fail!');
        phantom.exit(1);
    } else {
        page.evaluate(function(){
            
        });
        setTimeout(function(){
            page.open(url, function(status){
                if (status !== "success") {
                    console.log('fail2');
                    phantom.exit(1);
                    return;
                }
                //page.render('page.png');
                console.log('finished!');
                phantom.exit();
            });
        }, 500);
    }
});
