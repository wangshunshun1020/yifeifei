/**
 * Created by jimmy-jiang on 2016/11/21.
 */
import { Token } from 'token.js';
import { Config } from 'config.js';
var app = getApp();
class Base {
    constructor() {
        "use strict";
        this.baseRestUrl = Config.baseUrl+Config.addonUrl;
        this.baseUrl = Config.baseUrl;
        
        this.onPay=Config.onPay;
    }

    //http 请求类, 当noRefech为true时，不做未授权重试机制
    request(params, noRefetch) {
        var that = this,
            url=this.baseRestUrl + params.url;
        if(!params.type){
            params.type='get';
        }
        /*不需要再次组装地址*/
        if(params.setUpUrl==false){
            url = params.url;
        }
        wx.request({
            url: url,
            data: params.data,
            method:params.type,
            header: {
                'content-type': 'application/json',
                'token': wx.getStorageSync('token')
            },
            success: function (res) {

                // 判断以2（2xx)开头的状态码为正确
                // 异常不要返回到回调中，就在request中处理，记录日志并showToast一个统一的错误即可
                var code = res.statusCode.toString();
                var startChar = code.charAt(0);
                if (startChar == '2') {
                    params.sCallback && params.sCallback(res.data);
                } else {
                    if (code == '401') {
                        if (!noRefetch) {
                            that._refetch(params);
                        }
                    }
                    that._processError(res);
                    params.eCallback && params.eCallback(res.data);
                }
            },
            fail: function (err) {
                //wx.hideNavigationBarLoading();
                that._processError(err);
                // params.eCallback && params.eCallback(err);
            }
        });
    }

    requestuploadimg(params) {
        var that = this;
        //    url=this.baseRestUrl + params.url;
        if(params.storage == 'local')
        {

            var url = that.baseRestUrl+'v1.Cars/uploadImg';

            var aliosstoken = '';

        }else if(params.storage == 'alioss')
        {
            var url = that.baseUrl+'/addons/alioss/index/upload';
            var aliosstoken = params.aliosstoken;

        }

        console.log(aliosstoken);

        var path = params.data.path;
        wx.uploadFile({
            url: url,
            filePath: path,
            name: 'file',
            header: { "Content-Type": "multipart/form-data" },
            formData: {
              //和服务器约定的token, 一般也可以放在header中
              'session_token': wx.getStorageSync('session_token'),
            'aliosstoken': aliosstoken
         
            },
            success: function (res) {


                params.sCallback && params.sCallback(JSON.parse(res.data));
                /*
              var getdata = JSON.parse(res.data);
              if (res.statusCode != 200) {
                wx.showModal({
                  title: '提示',
                  content: '上传失败',
                  showCancel: false
                })
                return;
              } else {
      
              }
              var imgpath = getdata.data.path;
              that.data.imagelist.push(imgpath);
            
              */
      
            },
            fail: function (e) {
      
              wx.showModal({
                title: '提示',
                content: '上传失败',
                showCancel: false
              })
            },
            complete: function () {
              wx.hideToast();  //隐藏Toast
            }
          })




    }


    _processError(err){
        console.log(err);
    }

    _refetch(param) {
        var token = new Token();
        token.getTokenFromServer((token) => {
            this.request(param, true);
        });
    }

    /*获得元素上的绑定的值*/
    getDataSet(event, key) {
        return event.currentTarget.dataset[key];
    };

};

export {Base};
