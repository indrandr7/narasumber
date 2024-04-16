function base_url() {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin+'/'+pathparts[1].trim('/')+'/'; // http://localhost/myproject/
    }else{
        var url = location.origin; // http://stackoverflow.com
    }
    return url;
}

function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
}

function noformatNumber(num) {
  return num.replace(/,/g, '');
}

function appendLeadingZeroes(n){
  if(n <= 9){
    return "0" + n;
  }
  return n
}

function format_datetimetoslash(datetime){
	var split_space = datetime.split(' ');
	var tanggal = split_space[0];
	var waktu = split_space[1];
	var split_tanggal = tanggal.split('-');
	var tanggal_slash = split_tanggal[2]+'/'+split_tanggal[1]+'/'+split_tanggal[0];
	var datetime_slash = tanggal_slash+' '+waktu;

	return datetime_slash;
}

function mydatetime(yourformat){
  var currdate = new Date()
  var formatted_date;

  if (yourformat == 'yyyymmdd'){
    formatted_date = currdate.getFullYear() + "-" + appendLeadingZeroes((currdate.getMonth() + 1)) + "-" + appendLeadingZeroes(currdate.getDate()) + " " + appendLeadingZeroes(currdate.getHours()) + ":" + appendLeadingZeroes(currdate.getMinutes()) + ":" + appendLeadingZeroes(currdate.getSeconds());
  }else if (yourformat == 'ddmmyyyy'){
    formatted_date = appendLeadingZeroes(currdate.getDate()) + "-" + appendLeadingZeroes((currdate.getMonth() + 1)) + "-" + appendLeadingZeroes(currdate.getFullYear()) + " " + appendLeadingZeroes(currdate.getHours()) + ":" + appendLeadingZeroes(currdate.getMinutes() + ":" + currdate.getSeconds());
  }
  return formatted_date;
}

function randomcode(length) {
   var result           = '';
   // var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}

function disableform(formid){
  return $(formid).css({'pointer-events':'none', 'background-color':'#E9ECEF'});
}

function enableform(formid){
  return $(formid).css({'pointer-events': 'auto', 'background-color':'#ffffff'});
}

function reload_table(){
	table.ajax.reload(null,false);
}

//RectaHost Configuration
function app_key(){
  var key = '123456789';
  return key;
}

function app_port(){
  var port = 1811;
  return port;
}

function wordwrap(str, width, brk, cut){
	brk = brk || 'n';
	width = width || 75;
	cut = cut || false;

	if (!str){ return str; }

	var regex = '.{1,' +width+ '}(\s|$)' + (cut ? '|.{' +width+ '}|.+$' : '|\S+?(\s|$)');

	return str.match(RegExp(regex, 'g')).join(brk);
}

function str_pad__(str, pad_length, pad_string, pad_type){
	var len = pad_length - str.length;

	if(len < 0) return str;
  	
	var pad = new Array(len + 1).join(pad_string);
    
	if(pad_type == "STR_PAD_LEFT") return pad + str;
    
	return str + pad;
}

function str_pad (input, pad_length, pad_string, pad_type) {

  // *     example 1: str_pad('', 30, '-=', 'STR_PAD_LEFT');
  // *     returns 1: '-=-=-=-=-=-foo bar milk'
  // *     example 2: str_pad('foo bar milk', 30, '-', 'STR_PAD_BOTH');
  // *     returns 2: '------foo bar milk-----'

  var half = '',
    pad_to_go;

  var str_pad_repeater = function (s, len) {
    var collect = '',
      i;

    while (collect.length < len) {
      collect += s;
    }
    collect = collect.substr(0, len);

    return collect;
  };

  input += '';
  pad_string = pad_string !== undefined ? pad_string : ' ';

  if (pad_type != 'STR_PAD_LEFT' && pad_type != 'STR_PAD_RIGHT' && pad_type != 'STR_PAD_BOTH') {
    pad_type = 'STR_PAD_RIGHT';
  }
  if ((pad_to_go = pad_length - input.length) > 0) {
    if (pad_type == 'STR_PAD_LEFT') {
      input = str_pad_repeater(pad_string, pad_to_go) + input;
    } else if (pad_type == 'STR_PAD_RIGHT') {
      input = input + str_pad_repeater(pad_string, pad_to_go);
    } else if (pad_type == 'STR_PAD_BOTH') {
      half = str_pad_repeater(pad_string, Math.ceil(pad_to_go / 2));
      input = half + input + half;
      input = input.substr(0, pad_length);
    }
  }

  return input;
}

function isset(param){
	if (typeof param !== 'undefined'){
		return true;
	}else{
		return false;
	}
}

