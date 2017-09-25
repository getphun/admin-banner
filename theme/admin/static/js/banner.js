$(function(){
    var el = $('#field-type');
    if(el.get(0)){
        el.change(function(){
            $('.ban-prop').addClass('hidden');
            var val = $(this).val();
            $('#ban-type-'+val).removeClass('hidden');
        });
        
        el.change();
    }
    
    var el = $('#field-name');
    if(el.get(0)){
        var titleDirty = false;
        var elTD = $('#field-ban_title');
        
        elTD.click(function(){ titleDirty = true; });
        elTD.keyup(function(){ titleDirty = true; });
        elTD.focus(function(){ titleDirty = true; });
        if(elTD.val())
            titleDirty = true;
        
        el.keyup(function(){
            if(titleDirty)
                return;
            elTD.val( $(this).val() );
        });
    }
    
    var el = $('.placement-selector');
    if(el.get(0)){
        el.children('a').click(function(){
            var el = $(this);
            var plc= el.data('placement');
            
            $('.placement-selector > a').removeClass('active');
            el.addClass('active');
            
            if(plc == '*')
                $('.placement-item').removeClass('hidden');
            else{
                $('.placement-item').addClass('hidden');
                $('.placement-item[data-placement="'+plc+'"]').removeClass('hidden');
            }
            return false;
        });
    }
})