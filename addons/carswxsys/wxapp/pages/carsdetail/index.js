import { Cars } from '../../model/cars-model.js';
var cars = new Cars(); 

import { User } from '../../model/user-model.js';
var user  = new User();

Page({

  /**
   * 页面的初始数据
   */
  data: {
    images: {},
    autoplay: true,
    interval: 3000,
    duration: 1000,
  
    hdimg: [],
    //是否采用衔接滑动  
    circular: true,
    //是否显示画板指示点  
    indicatorDots: false,
    //选中点的颜色  
    indicatorcolor: "#000",
    //是否竖直  
    vertical: false,
    //是否自动切换  
    //滑动动画时长毫秒  
    //所有图片的高度  
    imgheights: [],
    //图片宽度  
    imgwidth: 750,
    //默认  
    current: 0,
    showpay: true,
    paytype: 0,
    swiperCurrent: 0,

    title:'',
    id: 0
  },


  imageLoad: function (e) {
    var imgwidth = e.detail.width,
      imgheight = e.detail.height,
      //宽高比  
      ratio = imgwidth / imgheight;
    console.log(imgwidth, imgheight)
    //计算的高度值  
    var viewHeight = 750 / ratio;
    var imgheight = viewHeight
    var imgheights = this.data.imgheights
    //把每一张图片的高度记录到数组里  
    imgheights.push(imgheight)
    this.setData({
      imgheights: imgheights,
    })
  },

  previewImg: function (e) {
    console.log(e.currentTarget.dataset.index);
    var index = e.currentTarget.dataset.index;
    var imgArr = this.data.piclist;
    wx.previewImage({
      current: imgArr[index],     //当前图片地址
      urls: imgArr,               //所有要预览的图片的地址集合 数组形式
    })
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (e) {

    

    var that = this;
    wx.showShareMenu({
      withShareTicket: true,
      menus: ['shareAppMessage', 'shareTimeline']
    })
    if (that.data.id > 0) {
      var id = that.data.id;
    } else {
      var id = e.id;
      that.data.id = e.id;
    }

    var params = { id:that.data.id};
 
    cars.getCarsDetail((data) => {
      that.data.title = data.title;
      wx.setNavigationBarTitle({
        title: data.title,
      })

     that.setData({
         data:data,
         piclist:data.piclist

     });

     wx.hideNavigationBarLoading(); //完成停止加载
     wx.stopPullDownRefresh();
 },params);


  },

  doCall: function (e) {
    console.log(e.currentTarget);
    var that = this;
    var tel = e.currentTarget.dataset.tel;
    var params = {};

    user.checkBind((data) => {

      if(data.isbind)
      {
                
        wx.makePhoneCall({
          phoneNumber: tel, //此号码并非真实电话号码，仅用于测试
          success: function () {
            console.log("拨打电话成功！")

            var params = { carid:that.data.id};

            cars.saveGuest((data) => {
            
                },params);



          },
          fail: function () {
            console.log("拨打电话失败！")
          }
        })

      }else{

        wx.navigateTo({
          url: '/pages/bindwx/index',
        })

      }

      
  },params);





  },

  doSaveCars: function (e) {
    var that = this;

    var params = { carid:that.data.id};

    cars.carSave((data) => {
     
      if(data.status == 0 )
      {
        that.data.savestatus = 1;
          that.setData({
            savestatus:1
        });
/*
        wx.showToast({
          title: data.msg,
          icon: 'success',
          duration: 2000
         })
  */  
  }else{
     
    that.data.savestatus =0;
    that.setData({
      savestatus:0
  });

  
    
  }
 },params);



  },

  toPloitecar:function(e){

    var id = e.currentTarget.dataset.id;

    wx.navigateTo({
      url: "/pages/ploitecar/index?id=" + id
    })
  },

  toContact:function(e){

    var id = e.currentTarget.dataset.id;

    console.log(id);

    wx.navigateTo({
      url: "/pages/openweb/index?id=" + id
    })
  },


  toContact2:function(e){

    var id = e.currentTarget.dataset.id;

    console.log(id);

    wx.navigateTo({
      url: "/pages/openuserweb/index?id=" + id
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
  onShow: function () {

  },

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
    this.onLoad();
  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage() {
    var that = this;
    return {
      title:  that.data.title,
      path: '/pages/carsdetail/index?id='+that.data.id
    }
  }
})