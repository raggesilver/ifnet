$(function(){

    $('.profile-view-name').text(profile_name);
    if(profile_phone === null || profile_name === '')
    {
        $('.profile-view-phone').html('Add phone number');
    }

    //profile_pic = 'images/default-user.png';
    $('#profile-view-pic').css({'background-image': 'url("' + profile_pic + '")',
                                'background-size': 'cover'});

});