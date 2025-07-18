import { Cars } from '../../model/cars-model.js';

var cars  = new Cars();

Page({

  /**
   * 页面的初始数据
   */
  data: {

  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;

    wx.setNavigationBarTitle({
      title: '我的发布',
    })
    var params = {};

    cars.myPubcars((data) => {

      wx.hideNavigationBarLoading(); //完成停止加载
      wx.stopPullDownRefresh();
      that.setData({
        carslist:data.carslist
      });
  },params);


  },

  toDown:function(e)
  {
    
    var that = this;
    var id = e.currentTarget.dataset.id;
    var shopid = wx.getStorageSync('shopid');
    wx.showModal({
      title: '提示',
      content: '确认下架？',
      success: function (res) {
        if (res.confirm) {
       
          var params = {id:id,shopid:shopid};

          cars.downCars((data) => {
      
            that.onLoad();


        },params);





        }
      }

    })

  },


  toUp:function(e)
  {
    
    var that = this;
    var id = e.currentTarget.dataset.id;
    var shopid = wx.getStorageSync('shopid');
    wx.showModal({
      title: '提示',
      content: '确认上架？',
      success: function (res) {
        if (res.confirm) {
       
          var params = {id:id,shopid:shopid};

          cars.upCars((data) => {
      
            that.onLoad();


        },params);





        }
      }

    })

  },
  toEditCars:function(e) {
    var that = this;
    var id = e.currentTarget.dataset.id;
    wx.navigateTo({
      url: "/pages/editcars/index?id=" + id
    })
    
  },
  toPayOrder:function(e) {
    var that = this;
    var id = e.currentTarget.dataset.id;
    wx.navigateTo({
      url: "/pages/payorder/index?id=" + id
    })
    
  },

  delCars:function(e) {
    var that = this;
    var id = e.currentTarget.dataset.id;
    wx.showModal({
      title: '提示',
      content: '确认删除？',
      success: function (res) {
        if (res.confirm) {
       


          var params = {id:id};

          cars.delCars((data) => {
      
            that.onLoad();


        },params);





        }
      }

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
  onShareAppMessage: function () {

  }
})