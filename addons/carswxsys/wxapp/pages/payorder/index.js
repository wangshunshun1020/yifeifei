import { Order } from '../../model/order-model.js';

var order  = new Order();

import { Pay } from '../../model/pay-model.js';

var pay  = new Pay();

import { Lookrole } from '../../model/lookrole-model.js';
var lookrole  = new Lookrole();
Page({

  /**
   * 页面的初始数据
   */
  data: {

    pid:0,
    roleid:0,
    couponid:0,
    title:'',
    totalmoney:0,
    roleid:0

  },


  showModal(e) {
    this.setData({
      modalName: e.currentTarget.dataset.target
    })
  },
  hideModal(e) {
    this.setData({
      modalName: null
    })
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {

    var that = this;
    wx.setNavigationBarTitle({
      title: '订单支付',
    })

that.data.pid = options.id;



var params = {};

lookrole.GetLookroleList((data) => {


that.setData({
  lookrolelist:data.lookrolelist,
  totalmoney:that.data.totalmoney
  
});

},params)



    
  },


  
  toPay: function (e) {
    var that = this;
   
        var pid = that.data.pid;

        var roleid = that.data.roleid;

    
       if(roleid > 0) 
       {


        var params = {pid: pid,type:'lookrole',roleid:roleid};

        order.LookRoleorder((data) => {
  
            pay.execPay(data.order_id,(res) => {

                wx.navigateBack({
                    delta: 1,
                  })
              
    
 

                                      
              })
              
            },params);








       }else{

         wx.showModal({
           title: '提示',
           content: '请选择置顶套餐',
           showCancel: false
         })
         return

       }



  },

  selectRole:function(e){
    var that = this;
    var id = e.currentTarget.dataset.id;
    that.data.roleid = id;
    var title = e.currentTarget.dataset.title;
    var money =  e.currentTarget.dataset.money;
    that.data.totalmoney = money;


that.setData({
  totalmoney:that.data.totalmoney,
  roleid:that.data.roleid,
  title:title

})

  },

  selectCoupon:function(e){

    var that = this;
    var id = e.currentTarget.dataset.id;
    that.data.couponid = id;
    var s = that.data.totalmoney;
    var title = e.currentTarget.dataset.title;
    var money = e.currentTarget.dataset.money;
    var totalmoney = s-money;
    that.data.title = title;
    that.setData({
      title:that.data.title,
      modalName:'',
      stotalmoney:totalmoney.toFixed(2),
      couponmoney:money.toFixed(2)
    });

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