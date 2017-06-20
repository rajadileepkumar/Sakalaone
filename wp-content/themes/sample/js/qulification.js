/**
 * Created by Raja on 07-Dec-16.
 */
var quali_array = new Array("Post Graduation","Graduation","Secondary Grduation");
var q_a = new Array();
q_a[0]="";
q_a[1]="MCA|MTECH|MPHARM";
q_a[2]="BE|B.COM|BCA";
q_a[3]="PUC|SSLC|DIPLOMA";
function print_quly(qul) {
    var option_str = document.getElementById(qul);
    //console.log(option_str);
    option_str.length=0;
    option_str.options[0] = new Option('Select Qualification','');
    option_str.selectedIndex = 0;
    for (var i=0; i<quali_array.length; i++) {
        option_str.options[option_str.length] = new Option(quali_array[i],quali_array[i]);
    }
}

function print_qual_sub(qual_sub,selectedIndex) {
    var option_str = document.getElementById(qual_sub);
    option_str.length=0;    // Fixed by Julian Woods
    option_str.options[0] = new Option('Select Qualification','');
    option_str.selectedIndex = 0;
    var sub_arr = q_a[selectedIndex].split("|");
    for (var i=0; i<sub_arr.length; i++) {
        option_str.options[option_str.length] = new Option(sub_arr[i],sub_arr[i]);
    }
}

