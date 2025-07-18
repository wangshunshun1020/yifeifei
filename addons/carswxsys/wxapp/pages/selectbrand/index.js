import { Brand } from '../../model/brand-model.js';
var brand = new Brand(); 
const app = getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    CustomBar: app.globalData.CustomBar,
    totype:0,
    toView:'#'
  },

  /**
   * 生命周期函数--监听页面加载
   */

  onShow: function () {

  },

  hideModal(e) {
    this.setData({
      modalName: null
    })
  },

  onLoad: function (options) {

    var that = this;
    wx.setNavigationBarTitle({
      title: '品牌列表',
    })

    that.data.totype = options.id;

    that.setData({
      totype:that.data.totype
  });

    var params = {};
    brand.getBrandList((data) => {
      
      that.setData({
          brandlist: data
      });
  },params);

  },

  
  selectbrand2:function(e){
    var that = this;
    var id = e.currentTarget.dataset.id;
    var params = {id:id};

    var name = e.currentTarget.dataset.name;

    that.data.brandname = name;
    that.data.brandid = id;

    brand.getBrandCarsList((data) => {
    
      that.setData({
          brandcarslist: data,
          modalName: e.currentTarget.dataset.target

      });
  },params);

  



  },

  selectbrand:function(e){
    var that = this;
    var totype = that.data.totype;
    var id = e.currentTarget.dataset.id;
    var name = e.currentTarget.dataset.name;
    var brandinfo={};
    brandinfo.name = that.data.brandname+'/'+name;
    brandinfo.sbrandid = id;
    brandinfo.brandid = that.data.brandid;
    console.log(brandinfo);
    wx.setStorageSync('brandinfo', brandinfo);
    wx.navigateBack({
      delta: 1,
    })




  },


  choiceWordindex: function (event) {
    let wordindex = event.currentTarget.dataset.wordindex;
    if (wordindex == '#') {
      this.setData({
        toView: '常用品牌',
      })
    } else {
      this.setData({
        toView: wordindex,
      })
    }
 
    console.log(this.data.toView);
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