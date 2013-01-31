<script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery.ajaxupload.js" ></script>
<style>
    .profileContainer {
        
    }
    
    .profileContainer button {
        float:right;
    }
    
    .profileEdit {
        float:left;
        display:none;
    }
    .userPic {
        float:left;
        margin-right: 15px;
        width:60px;
        height:60px;
        background-color:white;
        padding:10px;
        margin-bottom:15px;
    }
    
    ul {
        margin:0;
        padding:0;
        list-style-type: none;
    }
    li {
        padding:0 0 7px 0;
        margin:0;
    }
    
    h2,h3 {
        margin-bottom:10px;
    }
    
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $("#userPic").ajaxUploadPrompt({
		url: '/views/upload.php',
		success: function (data, status, xhr) {
                    console.log(data);
		},
                error: function (e) {
                    console.log(e);
                }
                
	});
    });
    
</script>
<div class="mainSub form">
    
        <div class="profileContainer clearfix">
            <div id="userPic" class="userPic">
                
            </div>
            <div class="profileView" id="profileView">
            <h3><?=$this->user->getFirstname() ." ". $this->user->getLastname(); ?></h3>
            Lives in Istanbul. A tech geek!<br/>            
            (<?=$this->user->getEmail();?>)<br/>
                <button onclick="javascript:$('#profileView').hide();$('#profileEdit').show();" >Edit My Profile</button>
            </div>
            <div id="profileEdit" class="profileEdit">
                <form action="<?php echo $this->getAction("update") ?>" method="post">
                <input type="text" placeholder="Your name" value="<?=$this->user->getFirstname()?>" name="firstname"/><br/>
                <input type="text" maxlength="120" placeholder="Something about yourself" value="" name="bio"/><br/>
                <input type="text" placeholder="Your website" value="" name="url"/><br/>
                <input type="text" placeholder="Your email" value="<?=$this->user->getEmail()?>" name="email"/>
                </form>
                <button>Update now</button>
            </div>
            
        </div>
        <hr/>
        <div>
            
                <h2>Notification Settings</h2>
                <ul>
                    <li>
                <input type="checkbox" name="listUpdateMail" value="<?=weeklyMail;?>" id="listUpdateMail">
                <label for="listUpdateMail">Send me a mail when my lists updated</label>
                    </li>
                    <li>
                <input type="checkbox" name="weeklyMail" value="<?=weeklyMail;?>" id="weeklyMail">
                <label for="weeklyMail">Send me a weekly mail about the topics i watch</label>
                    </li>
                </ul>
            
        </div>
</div>