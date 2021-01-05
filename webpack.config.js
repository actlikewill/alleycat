const path = require('path');

module.exports = {
    entry: {
        'admin': ['./src/admin.js', './src/admin.scss'],
        'form' : ['./src/form.js', './src/form.scss'],
        'slider' : ['./src/slider.js', './src/slider.scss']
        
    },
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, 'assets')
    },
    module: {
        rules: [            
            {
                test: /\.scss$/,
                exclude: /node_modules/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            outputPath: '/',
                            name: '[name].css'
                        }
                    },
                    'sass-loader'
                ]
            }
        ]
    }
}