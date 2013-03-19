<?php
/**
 * Gets current Unix timestamp (in seconds) with microseconds, as a float.
 *
 * @return float
 */
function getMicrotime()
{
    list($usec, $sec) = explode(" ", microtime());

    return ((float) $usec + (float) $sec);
}


/**
 * Converts a unix timestamp to a relative time string, such as "3 days
 * ago" or "2 weeks ago"
 *
 * @param   int     $from    The date to use as a starting point
 * @param   int     $to      The date to compare to. Defaults to the
 *                           current time
 * @param   string  $suffix  The string to add to the end, defaults to
 *                           " ago"
 * @return  string
 *
 * @access  public
 * @since   1.0.000
 * @static
 */
public static function human_time_diff( $from, $to = '', $as_text = false, $suffix = ' ago' )
{
    if ( $to == '' ) {
        $to = time();
    }

    $from = new DateTime( date( 'Y-m-d H:i:s', $from ) );
    $to   = new DateTime( date( 'Y-m-d H:i:s', $to ) );
    $diff = $from->diff( $to );

    if ( $diff->y > 1 ) {
        $text = $diff->y . ' years';
    } else if ( $diff->y == 1 ) {
        $text = '1 year';
    } else if ( $diff->m > 1 ) {
        $text = $diff->m . ' months';
    } else if ( $diff->m == 1 ) {
        $text = '1 month';
    } else if ( $diff->d > 7 ) {
        $text = ceil( $diff->d / 7 ) . ' weeks';
    } else if ( $diff->d == 7 ) {
        $text = '1 week';
    } else if ( $diff->d > 1 ) {
        $text = $diff->d . ' days';
    } else if ( $diff->d == 1 ) {
        $text = '1 day';
    } else if ( $diff->h > 1 ) {
        $text = $diff->h . ' hours';
    } else if ( $diff->h == 1 ) {
        $text = ' 1 hour';
    } else if ( $diff->i > 1 ) {
        $text = $diff->i . ' minutes';
    } else if ( $diff->i == 1 ) {
        $text = '1 minute';
    } else if ( $diff->s > 1 ) {
        $text = $diff->s . ' seconds';
    } else {
        $text = '1 second';
    }

    if ( $as_text ) {
        $text = explode( ' ', $text, 2 );
        $text = self::number_to_word( $text[0] ) . ' ' . $text[1];
    }

    return trim( $text ) . $suffix;
}
?>