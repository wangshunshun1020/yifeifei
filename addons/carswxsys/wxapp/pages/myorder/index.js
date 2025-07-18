import { Order } from '../../model/order-model.js';

var order  = new Order();

import { Pay } from '../../model/pay-model.js';

var pay  = new Pay();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    city: wx.getStorageSync('companyinfo').city,
    isCars: true,	// 选择车源开关
    isSort: true,	// 选择排序开关
    isPrice: true,	// 选择价格开关
    isType:true,
    loadMore: '',

    page:1,
    isArea:true,
    areaid:0,
    priceid:0,
    cateid:0,
    isPrice:true,
    isCate:true,
    areatitle:'',
    pricetitle:'',
    catetitle:'',
    jobln:0,
    status:-1



  },

  toEdu:function(e) {
    var that = this;
    
    var status = e.currentTarget.dataset.id;
    that.data.status = status;

    that.initpage();
    that.setData({
      status:status
    })

  },

  toCarsDetail:function(e){

    var that = this;
    var id = e.currentTarget.dataset.id;
    
    wx.navigateTo({
       url: "/pages/carsdetail/index?id=" + id
      })
  


  },

  toPay:function(e){
    var that = this;
    var id =  e.currentTarget.dataset.id;
    wx.navigateTo({
      url: '/pages/payorder/index?id='+id,
    })

  },



  toPay2:function(e){

    var that = this;

    var pid = e.currentTarget.dataset.id;

        pay.execPay(pid,(res) => {

          that.onShow();
          


                                  
          })
          
 

  },


  toAddAgentOrder:function(){

    wx.navigateTo({
      url: '/pages/addagentorder/index',
    })


  },

  onLoad: function (e) {
    
    var that = this;
    that.data.type = e.type;
    var title = '我的订单';
 

      wx.setNavigationBarTitle({
        title:title,
      })
  },
  
  /**
   * 生命周期函数--监听页面加载
   */
  onShow: function () {

     var that = this;
    
     var cityinfo = wx.getStorageSync('cityinfo');
  
     that.setData({
      city:cityinfo.name
    });

     wx.showShareMenu({
      withShareTicket: true,
      menus: ['shareAppMessage', 'shareTimeline']
    })

    that.initpage();

 

  },


  initpage:function(){
    var that = this;

    var params = {status:that.data.status  };

    order.myOrder((data) => {

      console.log(data);


      that.setData({
         guestlist:data.list,
         totalcount:data.totalcount,
         totalcount_0:data.totalcount_0,
         totalcount_1:data.totalcount_1,
  
         
    });

    

    wx.hideNavigationBarLoading(); //完成停止加载
    wx.stopPullDownRefresh();



  },params);

  },


  toGuestDetail:function(e){
    var id = e.currentTarget.dataset.id;
    wx.navigateTo({
      url: "/pages/agentfindshopdetail/index?id=" + id
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



  onReachBottom(params) {
    var that = this;
    /*
    that.setData({
      loadMore: '正在加载中...'
    })

    */
    this.data.page = this.data.page+1;
    this.getjoblist();
  },
  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

    return {
      title: '找工作',
      path: '/pages/findjob/index'
  }

  }
})