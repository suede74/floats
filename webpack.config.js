'use strict';
const ExtractTextPlugin = require('extract-text-webpack-plugin');


module.exports = {
    entry: {
        main: './public/js/main.js',
    },
    module: {
        rules: [
            {
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['env']
                    }
                }
            },
            { 
                test: /\.scss$/,
                //loader: 'style-loader!css-loader!autoprefixer-loader!sass-loader'
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: ['css-loader', 'autoprefixer-loader', 'sass-loader']
                })
            },
            { 
                test: /\.jpg$/,
                /* base64 適合使用的情境
                    1. 獨立圖片, 無法用 Sprite
                    2. 不會更新 (沒有 cache)
                    3. 尺寸不大 (編碼後造成的效能缺陷不明顯)
                    4. 大量重複使用 (可以減少很多 request)
                */    
                loader: 'url-loader',
                // 圖片輸出路徑, 會自動加上 publicPath
                options: { 
                    outputPath: 'img/',
                    // 超過會自己找 file-loader
                    limit: 8192
                }
            }
        ]
    },
    plugins: [
        // 全部都變成外部資源，沒有 inline
        //new ExtractTextPlugin('[name].css', {allChunks: true})
        new ExtractTextPlugin('css/[name].css')
    ],
    output: {
        //publicPath: __dirname + '/dist/',
        publicPath: '/public/js/dist/',
        // 根目錄, 包含圖片與樣式, 所以要寫第一層
        path: __dirname + '/public/js/dist/',
        filename: '[name].bundle.js'
    }
}