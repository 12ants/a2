<?php

namespace Simple_History\Event_Details;

/**
 * A group with a single item, just plain output, no table or inline or similar.
 * They are added to the details group without a group first (group is generated in add function).
 * TODO: How to handle values? Placeholders?, {} or %s-format?
 */
class Event_Details_Group_Single_Item_Formatter extends Event_Details_Group_Formatter {
	public function to_html( $group ) {
		$output = '';

		foreach ( $group->items as $item ) {
			$formatter = $item->get_formatter();
			$output .= $formatter->to_html();
		}

		return $output;
	}

	public function to_json( $group ) {
		$output = [];

		// Use same formatter as inline items.
		foreach ( $group->items as $item ) {
			$formatter = $item->get_formatter();
			$output[] = $formatter->to_json();
		}

		return [
			'title' => $group->get_title(),
			'items' => $output,
		];
	}
}
