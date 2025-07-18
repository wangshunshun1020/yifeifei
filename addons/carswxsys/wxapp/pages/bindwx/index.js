const defaultAvatarUrl2 = '../../imgs/icon/qpic.png'



import { User } from '../../model/user-model.js';

var user  = new User();

import { Cars } from '../../model/cars-model.js';

var cars  = new Cars();

import {My} from '../my/my-model.js';
var my=new My();


import { Token } from '../../utils/token.js';

var token = new Token();


Page({
  data: {
    avatarUrl: defaultAvatarUrl2,
    avatarUrlimg:''
  },
  onChooseAvatar(e) {
    var that = this;
    const { avatarUrl } = e.detail 
    that.data.avatarUrl = avatarUrl;
    that.uploadimg(that.data.avatarUrl,1);
    this.setData({
      avatarUrl,
    })
  },
  onShow:function()
  {
    var that = this;

    token.getTokenPhoneNumFromServer((data)=>{


    })
    
  },
  onLoad:function()
  {
    var that = this;
    wx.setNavigationBarTitle({
      title: '微信绑定资料',
    })
    var params = {};

    my.UserInit((data) => {
  
      that.data.avatarUrlimg = data.userinfo.avatarUrl;
      that.setData({
        userinfo:data.userinfo,
        tel:data.userinfo.tel,
        avatarUrl:data.userinfo.avatarUrl,
        defaultAvatarUrl2:defaultAvatarUrl2
      });

        wx.hideNavigationBarLoading(); //完成停止加载
        wx.stopPullDownRefresh();

    },params);

  },
  savepubinfo: function (e) {
    var that = this;

    var nickname = e.detail.value.nickname;
    var tel = e.detail.value.tel;
    var avatarUrlimg = that.data.avatarUrlimg;

    if( avatarUrlimg == '')
    {
      wx.showModal({
        title: '提示',
        content: '请上传头像',
        showCancel: false
      })
      return

    }
    if(nickname == '')
    {

      wx.showModal({
        title: '提示',
        content: '请输入昵称',
        showCancel: false
      })
      return



    }

    if(tel == '')
    {

      wx.showModal({
        title: '提示',
        content: '请获取手机号',
        showCancel: false
      })
      return



    }


    var params = {avatarUrl: avatarUrlimg,nickname:nickname,tel:tel};


    user.Updateuser((data) => {

        wx.showToast({
          title: '修改成功',
          icon: 'succes',
          duration: 1000,
          mask:true,
          success:function() {

          wx.navigateBack({
            delta: 1,
          })
          
          }
      })   
                              
                          },params);









  },


  doCall: function (e) {
    console.log(e.currentTarget);
    var tel = e.currentTarget.dataset.tel;
    wx.makePhoneCall({
      phoneNumber: tel, //此号码并非真实电话号码，仅用于测试
      success: function () {
        console.log("拨打电话成功！")
      },
      fail: function () {
        console.log("拨打电话失败！")
      }
    })

  },
  
  getPhoneNumber: function (e) {
    var that = this;


  token.getTokenPhoneNumFromServer((data)=>{


    if (e.detail.errMsg == 'getPhoneNumber:fail user deny') {
      wx.showModal({
        title: '提示',
        showCancel: false,
        content: '未授权',
        success: function (res) { }
      }) 
    } else {
    
      var params = {iv: e.detail.iv, encryptedData: e.detail.encryptedData};
      user.getPhone((data) => {

        that.data.istel= true;
        that.setData({
          istel:that.data.istel,
          tel:data.tel
        });

          },params);



    }



  }


  )


  
  },

  uploadimg: function (path,id) {
    //var uploadurl = app.util.geturl({ 'url': 'entry/wxapp/upload' });
    // var id = id;
    wx.showToast({
      icon: "loading",
      title: "正在上传"
    });

    var that = this;

     var params ={

      path:path

     }
     cars.uploadimg((data) => {

  

      if(id == 1)
      {


        that.data.avatarUrlimg = data.imgpath;

      }else if(id == 2){

        that.data.imagelist.push(data.imgpath);

      }



                            
                        },params);






  },



  
})