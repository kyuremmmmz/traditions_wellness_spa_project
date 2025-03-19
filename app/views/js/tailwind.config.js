tailwind.config = {
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                // Light theme colors
                primary: '#006736',
                primaryHover: '#009950',
                onPrimary: '#FFFFFF',
                secondary: '#F2F9F1',
                secondaryVariant: '#98AB94',
                onSecondary: '#0C2108',
                surface: '#FAFAFA',
                highlightSurface: '#F4F4F5',
                onSurface: '#3F3F46',
                background: '#FFFFFF',
                onBackground: '#09090B',
                onBackgroundTwo: '#71717A',
                onBackgroundLink: '#5490F2',
                border: '#E4E4E7',
                borderTwo: '#CBD5E1',
                borderHighlight: '#669FFC',
                success: '#15803D',
                destructive: '#D92626',
                yellow: '#FFEA06',
                blue: '#32A3FF',
                orange: '#FDA93C',

                // Dark theme colors
                darkPrimary: '#006736',
                darkPrimaryHover: '#009950',
                darkOnPrimary: '#FFFFFF',
                darkSecondary: '#12240F',
                darkSecondaryVariant: '#657B60', 
                darkOnSecondary: '#F4F4F4',
                darkSurface: '#181818',
                darkHighlightSurface: '#2B2B2B',
                darkOnSurface: '#E0E0E0',
                darkBackground: '#050505',
                darkOnBackground: '#FAFAFA',
                darkOnBackgroundTwo: '#B2B2B2',
                darkOnBackgroundLink: '#5490F2',
                darkBorder: '#262629',
                darkBorderTwo: '#1E293B',
                darkBorderHighlight: '#669FFC',
                darkSuccess: '#15803D',
                darkDestructive: '#D92626',
            },
            fontFamily: {
                inter: ['Inter', 'sans-serif'],
            },
            letterSpacing: {
                'custom': '-0.3px',
            }
        }
    },
    plugins: [
        function ({
            addComponents
        }) {
            addComponents({
                '.HeaderOne': {
                    fontSize: '28px',
                    fontWeight: '600',
                    lineHeight: '150%'
                },
                '.HeaderTwo': {
                    fontSize: '22px',
                    fontWeight: '600',
                    lineHeight: '150%'
                },
                '.SubHeaderOne': {
                    fontSize: '22px',
                    fontWeight: '500',
                    lineHeight: '150%'
                },
                '.SubHeaderTwo': {
                    fontSize: '17px',
                    fontWeight: '500',
                    lineHeight: '150%'
                },
                '.BodyMediumOne': {
                    fontSize: '16px',
                    fontWeight: '500',
                    lineHeight: '150%'
                },
                '.BodyMediumTwo': {
                    fontSize: '14px',
                    fontWeight: '500',
                    lineHeight: '150%'
                },
                '.BodyOne': {
                    fontSize: '16px',
                    fontWeight: '400',
                    lineHeight: '150%'
                },
                '.BodyTwo': {
                    fontSize: '14px',
                    fontWeight: '400',
                    lineHeight: '150%',
                },
                '.CaptionMediumOne': {
                    fontSize: '12px',
                    fontWeight: '500',
                    lineHeight: '150%'
                },
                '.CaptionMediumTwo': {
                    fontSize: '10px',
                    fontWeight: '500',
                    lineHeight: '150%'
                },
                '.CaptionOne': {
                    fontSize: '12px',
                    fontWeight: '400',
                    lineHeight: '150%'
                },
                '.CaptionTwo': {
                    fontSize: '10px',
                    fontWeight: '400',
                    lineHeight: '150%'
                },
                '.MiniOne': {
                    fontSize: '10px',
                    fontWeight: '400',
                    lineHeight: '150%'
                },
                '.MiniTwo': {
                    fontSize: '8px',
                    fontWeight: '400',
                    lineHeight: '150%'
                },
                'OneColumnContainer': {
                    width: '326px',
                    display: 'flex',
                    flexDirection: 'column',
                    justifyContent: 'center',
                    alignItems: 'center'
                },
                'FormContainer': {
                    width: '326px',
                    display: 'flex',
                    flexDirection: 'column',
                    justifyContent: 'center',
                    alignItems: 'center'
                },
                'FieldContainer': {
                    width: '326px',
                    display: 'flex',
                    flexDirection: 'column',
                    height: '66px'
                }
            })
        }
    ]
};