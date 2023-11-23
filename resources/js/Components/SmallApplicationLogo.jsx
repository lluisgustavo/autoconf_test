export default function SmallApplicationLogo(props) {
    return (
        <svg
            {...props}
            xmlns="http://www.w3.org/2000/svg"
            width="512"
            height="512"
            viewBox="0 0 512 512"
            version="1.1"
        >
            <path
                d="M 243.500 263.348 C 228.448 268.325, 223.649 273.622, 207.126 303.500 C 199.826 316.700, 192.397 329.377, 190.617 331.670 C 180.944 344.133, 167.770 350.371, 151 350.429 C 144.117 350.453, 139.985 349.931, 136 348.534 C 128.943 346.060, 128.333 345.974, 128.333 347.455 C 128.333 348.132, 124.149 356.224, 119.034 365.439 C 108.775 383.921, 106.562 389.032, 105.542 396.594 C 104.478 404.487, 108.609 422.977, 111.095 421.442 C 111.580 421.142, 111.728 421.546, 111.423 422.341 C 110.548 424.620, 122.119 436.256, 128.719 439.735 C 147.438 449.602, 171.643 445.590, 187.009 430.073 C 192.551 424.477, 195.574 419.784, 207.351 398.500 C 223.075 370.081, 226.401 365.918, 237.948 360.193 C 245.122 356.636, 245.787 356.500, 256 356.500 C 266.213 356.500, 266.878 356.636, 274.052 360.193 C 285.599 365.918, 288.925 370.081, 304.649 398.500 C 316.426 419.784, 319.449 424.477, 324.991 430.073 C 337.266 442.468, 354.747 447.579, 372.201 443.876 C 383.484 441.482, 395.831 432.239, 401.390 422.024 C 405.039 415.320, 407.336 404.014, 406.474 397 C 405.507 389.137, 403.443 384.314, 392.966 365.439 C 387.851 356.224, 383.667 348.132, 383.667 347.455 C 383.667 345.974, 383.057 346.060, 376 348.534 C 372.015 349.931, 367.883 350.453, 361 350.429 C 344.230 350.371, 331.056 344.133, 321.383 331.670 C 319.603 329.377, 312.174 316.700, 304.874 303.500 C 289.761 276.173, 285.625 271.068, 274.274 265.735 C 268.282 262.920, 266.346 262.522, 257.500 262.289 C 251.197 262.123, 246.021 262.514, 243.500 263.348 M 105.272 308 C 105.272 310.475, 105.467 311.488, 105.706 310.250 C 105.944 309.012, 105.944 306.988, 105.706 305.750 C 105.467 304.512, 105.272 305.525, 105.272 308 M 406.272 308 C 406.272 310.475, 406.467 311.488, 406.706 310.250 C 406.944 309.012, 406.944 306.988, 406.706 305.750 C 406.467 304.512, 406.272 305.525, 406.272 308"
                stroke="none"
                fill={props.color}
                fillRule="evenodd"
            />
            <path
                d="M 249.135 72.030 C 236.556 73.858, 223.978 83.037, 217.232 95.312 C 215.664 98.165, 190.934 142.833, 162.278 194.573 C 133.621 246.313, 109.415 290.413, 108.487 292.573 C 107.559 294.733, 106.560 300.386, 106.268 305.136 C 105.558 316.662, 108.125 325.423, 114.769 334.147 C 119.601 340.492, 128.708 347.705, 130.097 346.287 C 130.521 345.854, 150.874 309.275, 175.324 265 C 224.923 175.186, 224.566 175.734, 237.873 169.229 C 245.211 165.641, 245.900 165.500, 256.052 165.500 C 266.233 165.500, 266.871 165.632, 274.205 169.257 C 287.474 175.815, 287.147 175.313, 336.676 265 C 361.126 309.275, 381.455 345.831, 381.851 346.235 C 383.237 347.651, 393.127 339.832, 397.551 333.824 C 406.738 321.345, 408.640 304.357, 402.352 290.955 C 398.967 283.741, 296.505 98.178, 291.834 90.803 C 283.124 77.050, 266.100 69.565, 249.135 72.030"
                stroke="none"
                fill={props.color}
                fillRule="evenodd"
            />
        </svg>
    );
}
