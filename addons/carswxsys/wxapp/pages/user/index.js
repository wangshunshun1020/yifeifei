// pages/user/index.js
import { Token } from '../../utils/token.js';

import {My} from '../my/my-model.js';
var my=new My();

import { Agent } from '../../model/agent-model.js';

var agent  = new Agent();

import { Shop } from '../../model/shop-model.js';

var shop  = new Shop();

import { User } from '../../model/user-model.js';

var user  = new User();

Page({

  /**
   * 页面的初始数据
   */
  data: {
    isuser:true,
    istel:true
  },

  toIndex:function(){
    var that = this;
      wx.redirectTo({
        url: '/pages/index/index',
      })


  },

  toCarslist:function(){
    var that = this;
      wx.redirectTo({
        url: '/pages/carslist/index',
      })


  },

  toPubCars:function(){
    var that = this;
    var params = {};

    user.checkBind((data) => {

      if(data.isbind)
      {
                
        wx.navigateTo({
          url: '/pages/pubcars/index',
        })

      }else{

        wx.navigateTo({
          url: '/pages/bindwx/index',
        })

      }

      
  },params);
   


  },

  toMyorder:function(){
    var that = this;
      wx.navigateTo({
        url: '/pages/myorder/index',
      })


  },

  /**
   * 生命周期函数--监听页面加载
   */
  onShow: function (options) {
    var that = this;

    wx.setNavigationBarTitle({
      title: '会员中心',
    })

    var params = {};

    my.UserInit((data) => {

     
            that.setData({
              userinfo:data.userinfo,
              isuser:data.isuser
            
            });


            wx.hideNavigationBarLoading(); //完成停止加载
            wx.stopPullDownRefresh();

        },params);


     
  },


  getPhoneNumber: function (e) {
    var that = this;
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
          istel:that.data.istel
        });

          },params);



    }
  },



  bindGetUserInfo:function(){

    var that=this;
    wx.navigateTo({
      url: "/pages/bindwx/index"
    })

    
  },

  updateuserinfo:function(){
    
    var that = this;
    var userinfo = wx.getStorageSync('userInfo');
    var params = {nickname:userinfo.nickName,avatarUrl:userinfo.avatarUrl};

    user.Updateuser((data) => {

        
      that.data.istel= data.istel;
      that.setData({
      
        istel:that.data.istel
     });

        },params);

  },

  toLogin: function (e) {


    var that = this;
    var params = {};

    shop.checkLogin((data) => {

      if(data.status == 0)
      {
        
      
        wx.setStorageSync('shopid',data.shopid);


        wx.navigateTo({
          url: "/pages/shopcenter/index"
        })

      }else if(data.status == 1){


        wx.navigateTo({
          url: "/pages/shopreg/index"
        })

      }else if(data.status == 2)
      {

        wx.showModal({
          title: '提示',
          content: data.msg,
          showCancel: false
        })
        return

      }

      
  },params);




  },

  toArticle:function(){

    wx.navigateTo({
      url: "/pages/article/index"
    })
  },
  toAgentcenter:function()
  {

    var that = this;

    var params = {};
 
    agent.Checkagent((data) => {

      if(data.status == 0 )
      {
        wx.navigateTo({
          url: "/pages/regagent/index"
        })

      }else if(data.status == 1){
        wx.navigateTo({
          url: "/pages/agentcenter/index"
        })
      
      }else{

        wx.showModal({
          title: '提示',
          content: data.msg,
          showCancel: false
        })
        return

      }

    },params);

   
  },

  
  toPubcars: function () {
    var that = this;
    wx.setStorageSync('brandinfo', '');
    wx.navigateTo({
      url: "/pages/pubcars/index"
    })
  },
  toMypubs:function(){
    var that = this;
    wx.navigateTo({
      url: "/pages/mypubs/index"
    })

  },

  toMySave: function (e) {

    var that = this;

    wx.navigateTo({
      url: "/pages/mysave/index"
    })

  },
  
  toMyGz: function (e) {

    var that = this;

    wx.navigateTo({
      url: "/pages/mygz/index"
    })
  
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */


  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {
    wx.showNavigationBarLoading();
    this.onShow();
  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})