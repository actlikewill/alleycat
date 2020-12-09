const path = require('path');

module.exports = {
    entry: [
        './src/index',
        './src/styles.scss'
    ],
    output: {
        filename: 'scripts.js',
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
                            name: 'styles.css'
                        }
                    },
                    'sass-loader'
                ]
            }
        ]
    }
}