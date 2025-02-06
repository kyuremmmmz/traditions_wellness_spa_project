tailwind.config = {
    theme: {
        extend: {
            colors: {
                // Light theme colors
                primary:            '#0F172A',
                primaryHover:       '#1E2D53',
                onPrimary:          '#FFFFFF',
                secondary:          '#F1F5F9',
                secondaryVariant:   '#94A3AB',
                onSecondary:        '#081021',
                surface:            '#FAFAFA',
                highlightSurface:   '#F4F4F5',
                onSurface:          '#3F3F46',
                background:         '#FFFFFF',
                onBackground:       '#09090B',
                onBackground2:      '#71717A',
                onBackgroundLink:   '#5490F2',
                border:             '#E4E4E7',
                border2:            '#CBD5E1',
                borderHighlight:    '#669FFC',
                success:            '#15803D',
                destructive:        '#D92626',
                
                // Dark theme colors
                darkPrimary:            '#3B4A6E',
                darkPrimaryHover:       '#4E6292',
                darkOnPrimary:          '#FFFFFF',
                darkSecondary:          '#18181B',
                darkSecondaryVariant:   '#204586',
                darkOnSecondary:        '#F4F4F4',
                darkSurface:            '#01050E',
                darkHighlightSurface:   '#E0E0E0',
                darkOnSurface:          '#F4F4F5',
                darkBackground:         '#050505',
                darkOnBackground:       '#FAFAFA',
                darkOnBackground2:      '#B2B2B2',
                darkOnBackgroundLink:   '#5490F2',
                darkBorder:             '#262629',
                darkBorder2:            '#1E293B',
                darkBorderHighlight:    '#D4D4D8',
                darkSuccess:            '#15803D',
                darkDestructive:        '#D92626',
                },
            fontFamily: {
                inter: ['Inter', 'sans-serif'],
            },
            letterSpacing: {
                'custom': '-2.2%',
            },
        }
    },
    plugins: [
        function ({ addComponents }) {
            addComponents({
                '.HeaderOne': {
                    fontSize: '28px', fontWeight: '600', lineHeight: '150%'
                },
                '.HeaderTwo': {
                    fontSize: '22px', fontWeight: '600', lineHeight: '150%'
                },
                '.SubHeaderOne': {
                    fontSize: '22px', fontWeight: '500', lineHeight: '150%'
                },
                '.SubHeaderTwo': {
                    fontSize: '17px', fontWeight: '500', lineHeight: '150%'
                },
                '.BodyMediumOne': {
                    fontSize: '16px', fontWeight: '500', lineHeight: '150%'
                },
                '.BodyMediumTwo': {
                    fontSize: '14px', fontWeight: '500', lineHeight: '150%'
                },
                '.BodyOne': {
                    fontSize: '16px', fontWeight: '400', lineHeight: '150%'
                },
                '.BodyTwo': {
                    fontSize: '14px', fontWeight: '400', lineHeight: '150%'
                },
                '.CaptionMediumOne': {
                    fontSize: '12px', fontWeight: '500', lineHeight: '150%'
                },
                '.CaptionMediumTwo': {
                    fontSize: '10px', fontWeight: '500', lineHeight: '150%'
                },
                '.CaptionOne': {
                    fontSize: '12px', fontWeight: '400', lineHeight: '150%'
                },
                '.MiniOne': {
                    fontSize: '10px', fontWeight: '400', lineHeight: '150%'
                },
                '.MiniTwo': {
                    fontSize: '8px', fontWeight: '400', lineHeight: '150%'
                }
            })
        }
    ], 
    
};