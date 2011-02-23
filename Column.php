<?php

/**
 * Unix column tool analogue for tabulated data
 *
 * @version 0.0.1
 * @author murchik <moorchegue@psymoorea.ru>
 */

class Column {

	const INCREASE_COLUMN_BY = 2;

	public function columnize($in) {
		$input = array();
		$columnSizes = array();

		$rows = explode("\n", $in);

		foreach ($rows as $rk => $rv) {
			$cols = explode("\t", $rv);
			foreach ($cols as $ck => &$cv) {
				$cv = trim($cv);
				$input[$rk][$ck] = $cv;

				$columnSizes[$ck] = (isset($columnSizes[$ck])
					&& $columnSizes[$ck] > mb_strlen($cv))
						? $columnSizes[$ck] : mb_strlen($cv);
			}
		}

		$out = '';
		foreach ($input as $rk => $rv) {
			foreach ($rv as $ck => $cv) {
				$factor = $columnSizes[$ck] + self::INCREASE_COLUMN_BY - mb_strlen($cv);
				$out .= $cv . str_repeat(' ', $factor);
			}
			$out = trim($out) . "\n";
		}

		return $out;
	}

}
