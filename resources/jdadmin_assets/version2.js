/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
        $(".patient_details").hide();
        $(".hide_banks").hide();
        dontype();
        blood_camp();
        $(".blood_camp").change(function(){
                blood_camp();
        }); 
        $(".donation_type").change(function(){
                dontype();
        }); 
        select_comp();
        $(".select_component").click(function(){
                select_comp();			
        }); 
        function select_comp(){
                blood_unit=[];
                $(".select_component").each(function(){
                        if($(this).is(":checked")){
                                blood_unit.push($(this).parent().parent().find("td:eq(1)").text()+" - "+$(this).parent().parent().find("td:eq(2)").text());
                        }
                        $(".selected_components").text("");
                        for($i=0;$i<blood_unit.length;$i++){
                                $(".selected_components").append("<div class='well well-sm col-md-1'><b>"+blood_unit[$i]+"</b></div>");
                        }
                });
        }
        function blood_camp(){
                var blood_camp   =   $(".blood_camp option:selected").val();
                $.post("/blood_camp",{blood_camp:blood_camp},function(data){
                        $(".camp_name").html(data);
                });
        }
        function dontype(){
                var dtype   =   $(".donation_type option:selected").val();
                if(dtype == '1'){
                        $(".patient_details").show();
                }else{
                        $(".patient_details").hide();
                }
        }
        if($('.bloodbank_type').is(":checked")){
                bloodbank_type(); 
        }
        $(".bloodbank_type").click(function(){ 
                bloodbank_type();
        });
        if($('.bloodbank_type').is(":checked")){
                bloodbank_type(); 
        }
        $(".bloodbank_type").click(function(){ 
                bloodbank_type();
        });
        if($('.bloodbank_transfer').is(":checked")){
                bloodbank_transfer(); 
        }
        $(".btn-viattr").click(function(){ 
                var viattr     =   $(this).attr("viattr");
                $(".viattr").val(viattr);
        });
        $(".btn-request").click(function(){ 
                var request_id     =   $(this).attr("request_id");
                $(".request_id").val(request_id);
        });
        $(".btn-remarks").click(function(){ 
                var text_data     =   $(".text_data").val();
                var viattr        =   $(".viattr").val();
                $.post("/admin/submitNotsatisfied",{viattr:viattr,text_data:text_data},function(data){
                        window.location.href = "blood-request-not-satisfied";
                });
        });
        $(".btn-requests").click(function(){ 
                var text_datap     =   $(".text_datap").val();
                var viattr        =   $(".request_id").val();
                $.post("/admin/request_submit",{viattr:viattr,text_datap:text_datap},function(data){
                        window.location.href = "issue_blood";
                });
        });
        $(".bloodbank_transfer").click(function(){ 
                bloodbank_transfer();
        });
        change_distr();
        $(".change_distr").change(function(){
                change_distr();
        });
        $(".transfer_bloodbank").change(function(){
                transfer_donors();
        });
});
function change_distr(){
        var change_distr = $(".change_distr option:selected").val(); 
        if(change_distr != "undefined"){
            $.post("/admin/change_distr",{change_distr:change_distr},function(data){
                    $(".assign_bloodbank").html(data); 
            });
        }
}
function bloodbank_transfer(){
        var label_val   =   $(".bloodbank_transfer:checked").attr("label-name");
        $.post("/get_bloodbanks",{label_val:label_val},function(data){
                $(".transfer_bloodbank").html(data);
        });
        transfer_donors();
}
$(".hide_donors").hide();
$(".hide_bag_num").hide();
transfer_donors();
function transfer_donors(){ 
        var daterange        =   $(".daterange").val();
        var screen           =   $(".screen:checked").val(); 
        var transfer_group   =   $(".transfer_group option:selected").val();  
        if(screen == '2'){
            $(".hide_donors").show();
            $(".hide_bag_num").hide();
            $.post("/get_transfer_donors",{daterange:daterange,screen:screen},function(data){
                    $(".transfer_donors").html(data);
            }); 
        }if(screen == '1'){
            $(".hide_donors").hide();
            $(".hide_bag_num").show();
            $.post("/get_transfer_num",{daterange:daterange,screen:screen,blood_group:transfer_group},function(data){
                    $(".transfer_bag_num").html(data);
            });   
        } 
}
function bloodbank_type(){
        var label_val   =   $(".bloodbank_type:checked").attr("label-name");
        $(".bname").html(label_val);
        $(".bnamep").attr("placeholder","Enter "+label_val+" Name ....");
        $(".bnamea").attr("placeholder","Enter "+label_val+" Address ....");
        if(label_val === "Blood Bank"){                
                $(".hide_banks").hide();
        }else{
                $(".hide_banks").show();
        }           
        if(label_val !== "BCTV (Blood Collection and Transportation Vehicles)"){
                $(".hide_bctv").show();
        }else{
                $(".hide_bctv").hide();
        }
        
        $(".login_type").val(label_val);
}
function confirmationDelete(anchor,val) {
        var conf = confirm('Are you sure want to delete this '+val+' ?');
        if(conf)
            window.location=anchor.attr("href");
}
$(".bulk_preparation").change(function(){
        var bpl     =   $(".bulk_preparation option:selected").val();
        if(bpl != ""){
            console.log(bpl);
            if(bpl == "2"){
                $.post("/admin/bulk_preparation",{status:bpl},function(data){
                        $(".col_prepare").html(data);
                });
            }
            if(bpl == "3"){
                $.post("/admin/bulk_component",{status:bpl},function(data){
                        $(".col_prepare").html(data);
                });
            }
            if(bpl == "4"){
                $.post("/admin/bulk_screen",{status:bpl},function(data){
                        $(".col_prepare").html(data);
                });
            }
        }
});
function btn_excel(){
        var     btn_excel   =   $(".btn_excel option:selected").val(); 
        var     url         =   $(".varurl").val();
        $("form").attr("action","admin/export_excel/"+btn_excel);
        searchFilter('',url);
}
 $(".btn-discr").click(function(){ 
        var text_datap      =   $(".text_dp").val();
        var viattr          =   $(".bbdonation_id").val();
        $.post("/admin/discard_submit",{viattr:viattr,text_datap:text_datap},function(data){ 
                window.location.href = "/admin/blood-discarded";
        });
});
$(".screen,.comp_type").click(function(){
        transfer_donors();
});